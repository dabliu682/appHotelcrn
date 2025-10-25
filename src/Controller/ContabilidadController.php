<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Movimientos;
use App\Entity\Detallesmov;
use App\Entity\Inventario;
use App\Entity\Productos;
use App\Entity\Services;
use App\Entity\Service;
use App\Entity\Turnos;
use App\Entity\Persons;
use App\Entity\Checkin;
use App\Entity\Gastos;
use App\Entity\Bonos;
use Dompdf\Options;
use Dompdf\Dompdf;



class ContabilidadController extends AbstractController
{
    public function registrarVenta($detalle, $producto, $cantidad, $valor)
    {
        $bd = $this->getDoctrine()->getManager();

        $turno = $bd->getRepository(Turnos::class)->findOneBy(['status' => 1]);
        $mov = $bd->getRepository(Movimientos::class)->findOneBy(['tipo' => 1, 'estado' =>1],['id' => 'desc']);
        
        if($detalle == 1)
        {
            $producto = $bd->getRepository(Productos::class)->find($producto);
        }
        else 
        {
            $producto = $bd->getRepository(Services::class)->find($producto);
        }

        $detalleMov = new Detallesmov();

        $detalleMov->setMov($mov);

        if($detalle == 1)
        {
            $detalleMov->setProducto($producto);

            $inventario = $bd->getRepository(Inventario::class)->findOneBy(['codigo' => $producto]);

            $salidas = $inventario->getSalidas();
            $existencias = $inventario->getExistencias();

            $inventario->setSalidas($salidas+$cantidad);
            $inventario->setExistencias($existencias-$cantidad);

            $bd->persist($inventario);
        }
        else
        {
            $detalleMov->setServicio($producto);
        }

        $detalleMov->setTurno($turno);      
        $detalleMov->setCantidad($cantidad);
        $detalleMov->setValor($valor);
        $detalleMov->setSaldo(0);
        $detalleMov->setEstado(1);
        $detalleMov->setFormapago(1);

        $bd->persist($detalleMov);

        $bd->flush();

        $detalles = $bd->getRepository(Detallesmov::class)->findBy(['turno' => $turno, 'mov' => $mov ],['id' => 'desc']);

        $tablaVentas = [];

        foreach ($detalles as $det) 
        {
            if(!is_null($det->getServicio()))
            {
                $producto = $det->getServicio()->getName();
            }
            else
            {
                $producto = $det->getProducto()->getCodigo().'-'.$det->getProducto()->getNombre();
            }    
            
            $tablaVentas[] = ['producto' => $producto, 'cantidad' => $det->getCantidad(),'valor' => $det->getValor() ];
        }

        $tablaMov = [];

        $detallesMov = $bd->getRepository(Detallesmov::class)->findBy(['turno' => $turno]);

        $agrupaMov = [];

        foreach ($detallesMov as $det) 
        {
            if(is_null($det->getServicio()) && is_null($det->getProducto()))
            {
                if($det->getMov()->getTipo() == 4)
                {
                    $tipoMov = 'Salidas';
                }
                else
                {
                    $tipoMov = 'Entradas';
                }
            }
            else
            {
                if(!is_null($det->getServicio()))
                {
                    if($det->getServicio()->getTipo()->getId() == 1 || $det->getServicio()->getTipo()->getId() == 2 || $det->getServicio()->getTipo()->getId() == 3)
                    {
                        $tipoMov = 'Hospedaje';
                    }
                    elseif($det->getServicio()->getTipo()->getId() == 4)
                    {
                        $tipoMov = 'Lavandería';
                    }
                }
                else
                {
                    $tipoMov = 'Tienda';
                }

            } 
            

            $agrupaMov[$tipoMov][] = ['recibido' => $det->getValor(), 'pendiente' =>  $det->getSaldo(), 'bono' => 0];
        }

        $bonos = $bd->getRepository(Bonos::class)->findBy(['turno' => $turno]);

        foreach ($bonos as $bono) 
        {
            $agrupaMov['Bonos'][] = ['recibido' => 0, 'pendiente' =>  0, 'estado' => 0, 'bono' => $bono->getValor()];
        }


        foreach ($agrupaMov as $key => $grupos) 
        {
            $valor = 0;
            $pendiente = 0;
            $bonos = 0;

            foreach ($grupos as $grupo) 
            {
                $valor += $grupo['recibido'];
                $pendiente += $grupo['pendiente'];
                $bonos += $grupo['bono'];
            }

            $tablaMov[] = ['concepto' => $key, 'valor' => $valor, 'pendiente' => $pendiente, 'bono' => $bonos];
        }

        return new JsonResponse(['tablaVentas' => $tablaVentas, 'tablaMov' => $tablaMov]);
    }

    public function generarFactura($id)
    {
        $bd = $this->getDoctrine()->getManager();

        $checkin = $bd->getRepository(checkin::class)->find($id);

        $datos = [];

        $fechaActual = new \DateTime('now');

        $datos['dia'] = $fechaActual->format('d');
        $datos['mes'] = $fechaActual->format('m');
        $datos['anio'] = $fechaActual->format('Y');
        $datos['numero'] = '00001';
        $datos['logo'] = "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5ED+tktRFAPJXxTgcaCqqhCCcy5qkMBLue222/713z4i9xGzfoKKoti3b1+VvezACZX9OY3Utm3bPvihD4ZhI3oHRgz52zqDyl8U4NZTFIUytv4KvSg7tOb60pe/9NWvfVViAKqqcs4553TvbNt2fU4t53yiBkInSfLBD33wlltulh2IBIPNX2T9aAwqfycoycdVz51ylb10j4b76EXFcfxP//z+6398/Yj/3er6qOu6qqpRFNE0pHr2ZllWlmVz5kqN4DP5/Oc/96UvXyI7EDmWz9/VHq3I989JhWGo8tcwDFVVwzAMgqCf/EUBHgfV16KevdUrsqNrqG3btr3nve/55S9/OYJ/SwiRpmn3gCRJFEVxHIdmELquW/1mnudBEJimaRiG7E9oRL773Uv/+V/+eQL7vCvL5O+aDwUDJIRIkmT+gDiOFUWhSUesv/xFAR4HVGX7z95Jc/PNN73jXe/Ytm3bUP+Vsiy73S4lra7riqIkSdLtdhljnudxzvft20ePwt1ud35+3jCM4S1O2TTXXnvte//qvbt375YdiEzI3yYry3J+fj6Koip/4zien59XFMX3/T7zFwW49erDJhdmL5J5eVdddeVb3/aW+++/f0jHF0LQfEHf933fd13X933HcWj5OsuyaCZDnuf0NOx5XqfTmZB2ix/f8OO3vu0t99x7j+xAZFo+f0EuIUQQBJzzqampTqdD6em6bp7nRVHYtj01NdVP/qIAt8yip3bR7EUH8ApdfsXlf/HmP//FL34xjINnWcY5932/PmMhjmPHcWzbLopC13Xf96enpynD68tSjrerr7n6z//iz37+i5/LDmTUlAN6XkH+NlCapmVZTk1N1fM3iiLXdek2us/8RQFuE13XF57gRe+acUO9Kj+4+gev/5M//tGPfjTwI6dpappmfbY+dRFR9oZhWA2ZmZyrbVmWX//6/7zpz/70rrvukh3LqFXrbFRrbiyfv7LjnXRpmlqWtXC1Ddd1i6Lodrt95i8KcGvout7xO4vmapXD6gGovqt1689uff0bXv/Zz35mgKOBaHJnPXu73a5pmjRqo5rxKfutj1S32/3wRz78l2/9ywceeEB2LKujqkqfI+Oq+b6kmqeA/G0mIURZlvX8rc/3HUj+YjekdlAUxfO8NEuTJFn0F+h7QCmNvF2bBx+cfdd73vWTm296zatf85CjH7Lm4wghsizTdV3TNFVV6R6Znn3p3rn+m7Lf9Ejdeecd//j+f/zOpZeWZSE7llXrs02Yqu9SZxz52xw0Z8EwjJ78XTjft/8zhSfgdqAFvuM4Xvijnvm+yN5+JEnyuc999lWv+v0vXvLFNa/KVJZlGIacc8aYpmm07DO1PNerb1mW1A4p+02PQhAEn/nsp1/16j/45re+2cbq26f6MpPVK4vO10f+SleWZRAEVHd1Xc/znPY4qq91xRgriqL//MUTcDsYhlGW5VLJibvmwbrz53e+5a1/+Y1v/O/LL/6ds88+e/k59T2r3iRJQkMzaNSGZVlhGHa7Xdu269WXhmLZtj32BTjLsmuv/dHH/uNjV/3gqvrOqZNmqerLkL9S9eRvHMeUv9TdYNs2TS5yHKen+kZR1P/W3SjAjUZnl3MuBG6NRyrLssu+d9mPrv3RuU889wUv+K2zzjxr0V/L85yGRFK6Ut8etT/TL+i67rouPRDnea7rOi1fF0WRYRjjPeY5iqIbbvjx57/w+cuvuJzmPQPDAMkmqfKX/pPyN03Tev56nkczkar8zfM8DEMaStlnACjAjea6LuciikLOS9O0VVWdnAWSmiAMw2988xuXX3H5aY887XGPe/xZZ541MzNTPwWapmmaRjmc53lZlr7v01IbaZpSfTUMw/O8OI7DMKyedSzLchxnLEc+l2Vx/7Zt11x99f9+839//OMbGrL7shQ9GxwtHHUFclX5S+3MZVnSLN44jpMkofpqmman06F1Nqr8pQat/vMXBbihqP9f13Xq983znHogFhbghd1LMFhxHP/wRz+89rprN2zYcPLJpzzmjDNOOvGkI4/c4vu+qqqe50VRRKttUE46jiOEoKWvqPnaMAxd16tOBDq5st/WIHHOgyC4//77b775pmt+eM2Pb/jxgw8+OOGLEtenElWld9H5vgz5K0mVv91uVwjheR6tMSmEoKWvqnvoqampsixpYAct5D6QAFCAG4Gu2lmWFcX+8SmGYTi2I5goipIxVpZlFEW+36FvQM/fRfaOAOd8586dl1/+vSuuuNz3/SNnjjzmmGMe8pBjtm7Z4vsdGt48PT1tmPvvkOI43j2323XdQy7LXrV3DdzuuaEs8Si4KIoijqO9e/ft2LnjnnvuueuXd/3iF7+4/7779s3vW/gVnQQ9aViNq6perEY4Y+OyRqFTQD3B1Ywj6u4NgoAxRjWY1qEc+L+OAtwIiqJomuZ5XhCEQnDbttM0VVXVsmzTNOK4YIzleR6GwcI7LzRnjZgQotvt3tG9444772CMKYpi6IZtO6Zl0NiNqmGKbpkP+bw7vAJc3c8NFue8LMskSdM0oaWChhR/u9AWdaxWjHsegnteqSo08leiLMuSJNmyZUue591ut9PpUCvjwho8DCjAjcA5D8PQdV3XdWhoe5qmURQxptiWXZYlbbtB35Wev4vslYiunmmWZXnGuqy6/tZnlQguFBXLCo65en1ltbJafw7u2WQQpVcumu+radrU1JRt25ZlBUHQ7XZ93zdNkx2owdS7ZNv2MFJYn52dHdLbm5mZGdKRRx9zkiSaNtxOO855HCdTnQ5TlDDcPwstjiPGmOd6iqLQCk1hFD344IP1J6pGfc6c83iJpULG0oEFjPZnJj0D1a+8iqIwlX4NJbjdhBBzc3OLJkVzcnBubm70n8xCQvDdu3YP/EI92M9ZCDE/P88Y63Q6FCptnbJ9+/b6aJsoinbs2FFfzn2AMeMJuClUVfU8lwteFqVt22XJy7IQQlANdh2X1leSHSbsV+vbO2gqYU8Nrkovqi9Ac2RZlue5oihZltGSzpqm0YKDYRhSeyStokOb+w6pnwgFuBFUVVUUtSiKNM04L33f9zw3DKN6DabnYNmRAmOM1ccZ0TlZtAYfKMN4+AVoChqxT6ttKIpimiZti+J5Xr0GR1FEv7/o3JNBQQFuBNt2NE0NgoAu2fRt8H0vCEKqwTSZ0nXc4Q3YgRU60NGrVlWVam1PDa43RANAE9D+vj07DGZZtnPnzp4aXBQF55xWdB9ePGM1GbGlNE3nvKRR0HS9pjFZnHPf9+hboihKksRplk7mHI/mEEIwQS0Wv36RNpdjvU/GGHgF0CxpmuZ5Xq++jDFapL266jKa2mAY9Y0IhwSPUzJpmu66jqZp9LRkGKbn7R90R98Gz/N838/znHojoihCAZZLCMEWq6o04opz0bO0LIw33Ga1S5Zl9f25K7TVehRFQRDQAjujiQdXCmk0Te90fOqQCIKg2w3iOKKlR+vPwVmWqapaFOUA96mFfixzwa36g2XHCKNQLdUuOxBYEdrfd6niSvP1qY16ZNPD8AQsh6Iovu9lWV5fKbcsizwvOh2fVkejlcGrsQDQEEIsN6S5vsec7EhhiJbf3xcaiJZYWOaU0TqUYRhWC7kPG56A5aABeEnSu79vWRZxHBuG6bouWjIbSFEUxsShfgGLC445LODcUrquZ1m2aKMF7e9rGIZhGFmWjebk4hIvh2GY9IC78EdFUXBeGroxrrvltIv4NXphf+/AIr/GxYHFN2QHDQCMsf0r+IZRFNGyrLQwO42z6fm1JEnop7Tn4GjCQxN049A3I81SwzAcx0ETtEQH5yEtqbH/AZdzTn+mHwkuGOb7AjQG9ebmeU7NzkmSuK5r2zZN852fn7dtm0Zj5XkeBIFhGLQC5Sg79VGA5SjLwjQNTdPLsne5fBpXmaYZ59yyrGqFdxixnoWdF67uK4SomqPrqz2jZRJAOqq+nU5H13XaHjSKIiEEtSzS/tzVLzuOQ52+tOAgdRGOIEgU4NGh5a44L4UQ1B5i21YY9hZgy7KEEJyXec5s20YBloLm+yq1+b776y4XTK32tGFUgOu5SicL/ffjR1XV+j0WdhJssizLsiybnp6u1lHwPE9V1WqXX8Mwqv19DcOgOSa0FjQV6dHEiQI8CpqmO45NX4WyLJMkyfM8iiLXdV3XS9OEtl6gb4Zl2WG4fxy8wjDLUIL9D7cLFnDev7PCr2swoybo+p6vDKtfjR3KX7pq19s/MBSrgYQQeZ5nWbZwAWcqq1WJrX6apmkcx/QXhRC0HtZookUBHjqa71uWJTWAmKZJs4yyLFMUxXEc0zTKshRC0CpoURTSpgu6rjHMMpSBCrCy+IIbB9Xg6vern1c7I8F4qPI3jmNquKrXXSzE0TQ0dbMoChpR1YNqMA2soR0Gqc35wCVXdxxnlM1XKMDDpSiK6zpFUdDGzoyxPM9d1/VcjzGWpmlRlIaxf7nRLMvSdP9ik5qmOY6TZtjtXAJFURnjS/+0d4dBNDiPq3r+GobRs9ckJnw3kKZpvu93u908z2mPo55foBocxzE9IiuK4vv+1NQUk9F2hQI8RIqiqKqmaVq3G9Rfp/sv13Vpl9/6OCxN01WV0fjnoijiOF7tPwr9UxTGmCoEX2pdSRr/jAvveFsqfxcbiwcNout6p9MJgiAMw0XXlXQcp95ALbEZAwV4iGhHSc45571PsVSD6V6sWmPSdV3LtLjgiqJkWR7HURtzW21nXapGVDHGDlxdl6/BsiOGIevJX0VRqsepnhosO1JgRVHQ/kWqquq6rus6PQdTDV5YXxuyrVwjghhXWZZ5nscYU1Vt4XQj6hJ2HZc6IRhjaZrRaixFUbS05VlVVXtUAwgHaEFHezXld7kaDOOtJ381Tat3K2LAXUPQmvl5nrMDW3Ezxmzbdl230+l0u13aX6GZZwoFeIhoERbP82zbiqJy4Z0yDb0ry/1X/7Is2ll2D7Juelp2CKuzYL4v27+wxv5hVqjBE6onfy3L8j2//gti/3cFT8DSCCG63W5Zlr7vG4bBGCvLshrV7Hlew2swrimDpyiKpuk0a7BaY8Vx3EVPf5IkCx+OW23Tps2yQ1gFunrWp3gqNPdLrfZUYAv3+oUxtlT+Tk9PT09P9fwyqq9caZqWZTk9PW2aJt1D04ZynuelaUpLanQ6HRpG18CThSfgQdI0jSYL0n9WU37p/osxt6Xduqty1FFHWZbVls0TlxrFWt/UqJrvC+Nt+fw95phjOp2p/v4FGDBawHnhUGfbtrMsi+PYNE0qyQfWjm0WPAEPjKbpnU5HVVVa5IwGMPueT+OZwzA0TYNGPsuOdLi2btm6YcPhsqM4tEOOX62fKUz3HHuHzN/jH3b8olNLYfSEEFEUJUkihFhqOFV92phpmqPZXnC18AQ8GIvu75tlmW3btmVzztM0pf4k13Vp+JXskIdlw4YNxz/sYQ88sE12IIcwxqcAVuuQ+cs5P+GEh2PYc3PQsOdlfqHasLnJt854Ah4My7IURYnjg3YuohXAszyjn9KYjnp341gyDOPMM89s/nukQVVCsKUup7jMTo5D5u+WLVtOOP4ElN6GUBSl0+nQMy6Nf14oz3NaW1B2sMtBAe6XpmmapmuaRuuILvyFLMtUVa3ve9XXcJ42XAIec8aZGzdulB3Foam018JibdFCMNbse2cYiBXm71lnnn3EEUdg2Y3moBWsaLgJTeOsK4oiTVO6r5Id6XJQgPtlWbbve7Tj1aK/UM1yof/sM4HzPG/+cNytW7c+9pzHyo5iRVRVZQoT/KALqxBCCI79fSfBSvLX87ynPOUp+DI0DdVg0zS73W6SJLSivhAiTdP5+fnG9vvWoQD3K0nisixVVVt6nqjCGON8MDfOrbj9VlX1mc+8YLolE4KpBnMu+AGCC8YUTPydBCvJ39NPf9SJjzhRdqSwiKoGB0EwPz8/Pz+/d+/eIAhM0/R9v//jDxsuMf06sA5LZuhGNYGhrtrfV3akI3XySSc/6UlPlh3FSlFbND0CKYqiqCo2NZoQh8zfDRvWP+vCZ5mmKTtSWFzVFk2rBzqOMz093cxlNxZCAR4AGhNflIXneT05bFmWZVm0LIvsMEdK07QX/OYLZmZmZAeyUvv7gxljWOd5wiyfv+efd/6pp5wqO0ZYTr0Ga5rWkHWeV0If3iVydnZ2SEcefcw7du6oFoxcFOecZuv7np/lWVmWNPBK1/Rqf9+BsC1rZmam/g1r7Oc8MzPzyt/7/f/nr9+3/GyB5qCFZLHG7wRaKn9POP6EV/7e72/dunX5v96cHFy/fv1oPrHlKYq64fANA79QL/85CyGCINi+ffvCG6lDklUH8QQ8MEKIMAzzIjdNy7Zt2kdlvttty5pQw/DC337hM5/xTNlRrMKBuUkY7DpxFuav67qv+N1XHHPMMbJDgxWh52BN06q9GZoPBXiQqv4kxhitpzNm6zyvlud5b3zDG0899ZGyA1kFjL2aWPX8zbL8t3/rhc94xjNkBwWrQDW4RU3QuNYMGN1H0+4cLfoeDM8xxzz07W9920OOfojsQFZh7BdLgaVQ/nLOX/LiF7/q91+laUjhlqEavNomaFlQgAePuiLqO2RNuMc85sx3vevdW7ZskR0IwIo85clPee0fva4V81ig1VCAh6J6DsbsBfKkc5/01+/764c+9KGyAwFYjqbpL/jNF7z9be847LDDZMcC4w8FeFhoXGWSJLIDaYonPOGJ7/+H9z/mjMfIDgRgca7rvebVr377297RkLHEMPZQgIdICEFzw4E88pGn/fM/feDFL3pJ85eIg0nz0Ic+9H1/9b4/ft3r0fIMI4MhBjBSMzMz73j7Ox7+8Id/8lOfvOuuX2C2D0jnut6FF1zwqlf9wfEPO152LDBZUIBh1CzLevr5Tz/ttNP+93+//o1vfmPbtm0owyCF4zhnn3X2RRdd/PjHPd6yLNnhwMRBAQY5Nm3c9Dsv/91nPP0Zl19x+eVXXH7XL+6Kk1h2UDARVFXduHHTOeec89znPPfss85yXU92RDChUIBBGkVRjjxyy0te/NLnPud5d9xx+40/ufHWn916333379u3N0mSalVIgD6pqqrreqfT2bxp8yMe8YgzzzzrzMecefTRR2OmPsiF7x/I5/v+GWc85owzHpNl2Z69e3bt2jU3Nzc/P18us4i0ogjB87zoKdLT01NDCnLfvvkhHRkxDzVmXdc9z1u3bt2JJ5648YiNU1NTWOwMGgIFGBrENM1NGzdt2rhpzUfA5iKIefQxA6wN7gQBAAAkQAEGAACQAAUYAABAAhRgAAAACVCAAQAAJEABBgAAkAAFGAAAQAIUYAAAAAlQgAEAACRAAQYAAJAABRgAAEACFGAAAAAJUIABAMZEURbYxLNFUIABAMZEWZaovy2CAgwAACABCjAAAIAEehu3vx59zEmSaFojblaSNJ2dndV1/ZAx9w/fDcSMmNsV8565Ocbkt0ELwXfv2j3wD7w5n/OgYm5EUQEAAJg0KMAAAAASoAADAABIgAIMADAmNE1TFEV2FLBSKMAAAGNCRQFuFRTglikKrHQDAIvLsoxzLjsKWCkU4JaJojDPc9lRAEATdefny7KUHQWsFApwy+zbuy+KItlRAEAT7dy1U3YIsAoowC2zd9/eXbt3yY4CABpHCHH//ffLjgJWAQW4ZcIwvOeee2RHAQCNE4bhr+75lewoYBVQgFuGc/7Tn/5UdhRroRwgOxCA8bTtgW3btm0bxpE1TTMMw7Is0zQ1Te//gEDwUbbPzbfctHfv3nXr1skOZKV6ii5qMMAw3Hzzzfv27RvsMTVNt21LVdVqcLVlqZzzJEnLspD9jlsPT8Dtc8899/z01nY8BCuKoqoqY0wcTHZcAOMmSZJrrrl6sMc0DKPT8YUQYU0URUII3/dM05T9pluvfQVYCME5n+SLeJZll112WVG04PZTUZSq4qIJGhjyd2juuPOOwd6Xa5rueV4cx1EUcc5N03RdzzCMsiyjKIqiyHGc+rZssAat+fg452maZlnGGAuCQFEUTdNM05zMb8APf3TNHXfecfJJJ8sOZDk91ZdexJV3MnHOsyyj/GWMTXj+Dhzn/Nvf/lYQBAM8pm1bWZalaaooiuu6jLE8zznfn795nmdZZtt2GIZI6jVrxxNwlmV79+7N89xxnE6n4/u+bdtCiCiK0jSVHZ0Ee/fu/epXv9Lwh2AqwOxA9UXj88TK83x+fp7y1/d95O/A3X777Vd8/4oBHlBVVV3XkyRhjDmOQ63QWZbV+32pNquqJvvdt1gLCnCe50EQuK47NTVlmqYQoixLXdc9z3McJ0mSyczhy6+4/Lrrr5MdxZKq6ktQeidWnudhGNKts2EYyN+By/P8i5d8cW5uboDH1HW9LEvOuaqqqqrGcVz/qaqqhmFwzjnnuo4CvHZNL8BCCKq+dMscBEEQBNVajIZhuK6bJEnDnwWHIQiCT3zy44PNOoDBosdcx3Esy6rG8iB/B+vKq6684orLB3vMWvPV/kGU9Z9qmmZZFmNMCExq6EvTC3Capqqq2rbNGAuCQFXVqakp13Wrs24Yhq7rVd/SRLnppps+89lP4+IFjZVlmaIodLEOw1BV1U6ng/wdoPvvv/8//+s/4yTu/1B1nHM6R5yXjDFNO+gx1zAMuotSFDRu9aXpBTjPc8peaqeqpy470K1ommZZlhP4PRBCfOnLX/rKV78iO5DFY6ufqaX+DOOtyl8qsY7jIH8HKAzDf////u0Xv/j5wI9Mjc+aplGXgW3bVIPpdkpVVbq1UlW1KLD3w9o1vQALIWgiaVmWhmH0/JQar+hbMpkJHMfx3/39314+6AaogahqMKYhTSzk7/Dkef7JT33isu9dNoyDl2VZFCXdPCVJwjl3XdfzPNd1dV2nkc80DxjLcfSj6QV4+et1WZY9bSMTaPv27e985zuu+eE1sgPpRQW4Zwg0LrUTBfk7JEVRfOGLn//s5z47vM0H0zQ1DIPGvdJs4CzLkiSl6qvrum3bUTTgpu9J04ICTH2chmGkaVr/ttEQeVVVy7KsVlyaTPfce89f/MWfX/a9y5pW2+o1mGEs9OSp8lfXdeTvoGRZ9tnPfeajH/voUAeQl2VBA+hc19U0rSzLPM/LslBV1XEcWqMDj799avqX3jTNPM+FEHQvFgRBkiRZlgVBUBSF53mMsTRNcR997333/sWb//xzn/tso8az0LJHjDFVVasmaFxqJ0dP/oZhSMvpIH/XrNvt/tu//9tHP/bRnqlBw5DneRCEiqJ4nuf7vut69AdqhW7Upaalmr4MjWEY1PpBswZpwGRRFLQ1B2Msz/OiKKampmRHKt/OnTvf/d53337HHa9+9as3b9osO5xfo2bn6jm4WtUdxh4tdBXHMc0k1DSNRs8if9fml7/85b/++7/+4AdXjSyJyrIIw0LTdE1TaUsGbMMwQE0vwHTz1e12FUVxHMcwDJo7SD9N0zRJEs/z8FBF4jj++Cf+6yc33fiaV//hk5/0ZLrGNQTanycQrWIYhmEcx7ZtU/5WP0X+rlwYht/97qWf+vSn7rv/vtH/62VZDK2veaI1vQAzxnRd73Q6NH+fZg3meV6WJTWAuK67cHTlJBNC3HTTTW944xvOe9rTXvbSl5122unYtAQkokWvoiiq8pcxhvxduTiJb7zhhku+dMn1P76+WsMExkMLCjBjTNf1qampPM/zPE+SJEkSmo5mmiamtSwqisKv/ffXrvj+FY9//BOe+5znPuaMx6xfvx6fFUhB99BFUVD+sgPTSZG/yyjLcseOHd/81je+853v/OQnPxn4UhvQBO0owIwxRVFM06SHuTAMZYfTDvv27fvf//36pZd+59hjjz37rHPOOvPM4084YeMRGz3Pwy40MEqKovS0P0MP2jAqDMMHtz94xx23//CHP7zu+uvvu+/e4U00Aun0mZmZIR16dnZ2SEcefcw7du4oy7YOHcqy7Pbbb7/99ts/+alPTE9PH3H4ERs3bjxs/XrPdWmh16V4vrfwRUPXNa3f4j3YfdN+HZthDG84T7fbHdKRO51OW2IWgud5wRjzfX9IMQ/pu9GcmDkv6TOslGWRJGkYBnv27p3bvXv33O4gCFo9VlFR1A2Hbxj4hXqcagrBY9AEKctybm5ubm7ujjvvkB0LAMCkw+BDAAAACVCAAQAAJEABBgAAkAAFGAAAQAIUYAAAAAlQgAEAACRAAQYAAJAABRgAAEACFGAAAAAJUIABAAAkQAEGAACQAAUYAABAAhRgAAAACVCAAQAAJEABBgAAkAAFGAAAQAIUYAAAAAlQgAEAYJCE4EVeyI6iBVCAAQBgkDjnXHDZUbQACjAAAIAEKMAAAAASoAADAABIgAIMAAAgAQrwiqiKqiiygwAAaANVVTVVkx1FC6AAr4hpmqZpyY4CAKAFdF13HFt2FC2AArwirutOTU3JjgIAoAU818MFcyVQgFfEcZzNmzbJjgIAoAU2bNgwPb1OdhQtgAK8IpqmHXfcw2RHAQDQAscdd1yn05EdRQvos7OzQzr0zMzMkI4sJeZzn3jupz79ySRJhvRPAwCMh2OPPXbHjh0DP+yY1RSGJ+CVO+mkk4455hjZUQAANNq66XWnnXa67CjaAQV4pQ4//PAnP+kpsqMAAGi0k08++ZiHHCM7inZAAV6FCy+4YMOGDbKjAABoKF3Xz3vaeZaFSZsrggK8CieddNIznv4M2VEAADTU6ac/6pxzHis7itZAAV4FTdNf9tKLtmzZIjsQAIDGsW37opddND09LTuQ1kABXp0TTzzx5Re9XNN02YEcRAghhOwgYK0URdE0XdN0VUU+TqKxyd/zzzv//PPOlx1FmyDhV+2FL3zR+eedJzuK/YQQnHMh6P/5mOTxJHFdd3p6utPxOx2/0+k4jqNg2fGJMU75e+yxx/7R//0jx3FkBzJSiqKoNatNXhTgVZuamvrTN77ppJNOkh0Io4xVaiiPZccFK6Ioiud5pmnGcRwEQRAEeZ5bluX7PmrwJBin/J2env7TN/zpCSc8XHYgI1U/a/WzufIjoACvxXHHHfeOt73z6KOOlhgDJSrdcx046wpjDNfutnAcV9f1+fn5NE2LoiiKIk0zduDMwngbp/y1bfu1f/S6p0/YAFU6a/V2izU0YKAAr9FZZ531nne/V1YNFkIwwRRFrb3ChODVHVmr27ImgaZppmlEUVSVW03TOx0/z/MwDHVd1/VmjTOAARqn/LVt+//+4R9dfNHFmjZZ+w/Smaq/oqoqnbuV30WhAK/dueee+7d/83cnnniinH9eYdVZrmcvW9ONGIwY1deiKOg/q+obRRFjzHEcbH855sYifzudzhte/4ZX/f6rDMOQHctILTxTVfVlBx6OV3IcFOC+nHXWWf/8/g+cf975Eu/+erIXWkFV1bIs6c/1Z19KYCEETuaEaG/+Hn3U0X/13ve94hWvME1TdiwSLFV92WpuoVCA+/Wwhz3sb//m797wJ2/cuHHj6P/19mbvhCvLUtM0RVE0Tas/+8JEaWn+GoZx/nnnf+hDH37Os5/TtDmZI1Odsp7quyoT+tkN1vT09Kv/4NVPePzj/+M//+O7l3232+0O/99UGBOcC8Z6x93RN6Fd+TyBiqIQQjiOo2kaPftWP9I0Xdf0IAlkxwjD09b8VVX1hBNOePlFL3/2s5/j+77scKSpD19fWH0Xdg8vBQV4MFRVfeQjT/t///pvfnzDj7/0pUuuuuqqHTt3DHA4a+0cK4pC+alwzhfJXi7adj89EQzDME1TVVXOeZ7neZ4nSeK6XlkW9WdfTdN838uLvOoehjEwBvlrWdYjHvGI5z7neRdecMHmzcPaFrCxek5JfbDVUkOxVnJYFOBBMk3zsec89qwzz/zVr+65+pqrr7nm6tvvuH3Hjh1xHPdTjGt/V9k/glIImvdNU9CqLwfnQlGYqjYvfSeYoiiu6xqGUZZlWXJNU13XLYoijpMkiS3L8jwvz3O2f2i0WRRF1RkMY6C9+avreqczddRRRz3q9Eede+65j37Uo9etWyc7KAmqJ93qP9mButtzC7XaQewowIOnafpxxx133HHHvfhFL961e9e2bdu2bdt21113hWG42jIshEjTVAhhWVa1TiE9P5mmqet6WZa2bVe3Y7quU89i/SD0nSiKvCxX96+H4bBaQT1vWI1XDYyZHnyzLKvOvq7rhmEURZHnuaZpaZpUGU4TgqXHfEgN/JwbGPNS+ZtlmWVZlL/UGUE/Wpi/C2NWFEXXDVVV+rxDW74B2TD0desOm9m8+aijjpqZObLT6TTxqXwkqvm+PS+y2rNv9Z+r7QxGAR4iXdc3b9q8edPmMx59xuzs7BqOkCRJkiRTU1NV9hZFEQSBZVmO49BAnpmZmZ7vwaCsLeaVmJkZVhMWYkbMzYk5juM4jtetW1fP3/n5edu2Xdel/GULruNyY4a6papvVWjr/7sGGAXdaHSn3FN9TdN0HKc+a6W2mA4ANEWaprZt91Rfy7Jc183zPAgC5G/zLdPF2/8pQwFuLlpftFoRqaq+rutWv1DNJQWARlmYv1R9Pc9jjAkhyrJE/jZcT4ld22oby0ABbhwhRJZl1TB3av1YWH0BoIGqft+e/K1XX9bONZ8nx6JnZ82rbSwDBbhxaBBsURS00VWWZdRa1VN98zynZRxkxwsAv0b3ypS/mqZR/vZUX8ZYlmXI38ZauCzowslFA7mFQgGWrH5GhRBJkqRpqmkatVzZtl2W5cLqWxRFmqaWZeE+GkCinvyN4zhJkmovDdu2Fz77MsaKokiSxLZt5G/T9JReaslYdGrvylfbWAYKsEx5nne73fq0k6Io6NaYvgSGYVQ7tNN0BWrgCoLAMAzLwnr9ANIsmr9pmlb5S/fNPfmbJMn8/LxpmrZty34HsIiFa24s/IV+lp+swzQkmehMR1HkeV6appxzuk2mmYK0xDk95sZxnGUZDafknBuGUSU2AEhR5W9ZlkmScM5pcm2WZdRAxRijx9woitI0rfLXNE3P85C/jbJweY36FKPFVgwdQB8wCrBMuq77vh+GIU1IoIddz/PCMAzDUFEU2uSrWnODBnRUDdQAIFGVv/Pz80IIuif2fT8IgiAIFEWp7qFp3RXKX2z23EB0b9RTceuv1Hf5HeAqdfgeSKaqKo3UqNKyXoM9z6MaTAvXyQ4WAA5C+VsUBa1uxhir12Df96kGq6o6mXv2tUvPCOeecVjDWB0W13TJ0jRN05Tao8IwpHmBVIN1XQ+CgFYJBoAGovz1fV9V1SAIqvz1fd8wjG63m2WZ7Bjh0OgZt/6QUz31DrWnAAVYGprvq2ma7/u2bVPvL01AYgdqsGEYqMEADVTPX8dxfN8XQlRjsqgGm6aJGtwK1TLOI67BAxhIvZQ2rmI6ypg55/Pz85TAdILLsqS9hH3fr3qJut1unufT09NLTRnE5ywx5oX7kS1cPHbR5WQlxjwQiLmevw8++CBjrCxL2tfZdd0qf2lOcKfTWduUX3zOQ425yl9ZMeMJWI5qugLNKaIruKZpnU6HHXgOpltsx3HWnL0wVJS9iw6PVFW1+umgBkxCcyyVv9SOFUUR5W+e59S4hfxtoEXzd8QwCGvUOOfUqqxpGo1nTtOUMUbPwVSDgyCYn5+n35+amqLBHdAcPbMUFh2sUZ/RjwI8NhbNXxovSflLIyiDYP82gtQZLDtqOMii+SsFCvBIUS8R53xqakrXdfoSpGkaRRGNmaxqMC0HbRgGZiw0zUr2Bx3qyEmQZan83blzZ70G+76f57kQAjOOGuiQXUKjhC/HSCVJUpZlvUNXURTasKzb7VY1WFVVrJLTTItmb334BkrvGFsqfz3PC4KgqsGqqmKVumZaKn9lxYM+4JFK09Q0zYUdQqZpWpZV70+CxlrqBI1g0gLItVT+GoZhmmaWZdUW3dBYjTpBKMCjQ89JSzVJGYahqmqe58jhJjtkfUUNHlcryd+iKKIoQv42VtNyEwV41Jbpe6DeozRNMfG3sQ55bcVz8HhbJn9VVfU8L8uy+vYM0ChNuzdCAR4dRVF0XafRVQt/SkXXNE3DMGhcNDTTMsW1ms4vO0YYvJXkL42aRP42WaNujlGAhyvP8yRJsiyjG2fLssqyjON40V+jgVe0tCwu4s1UXyS2R/3FRiU5rFme53Ec005lbNn8TdO0yt+yLJG/zVFvkVomf6XAKOhhEUKEYZjnOe0cOT8/77ou7Q9K+5fZtq1pGs3WD8PQsiws195k1Q6gC/dFqaYV4rI7NoQQQRDQHqA0xH2Z/A2CgNquZEcNB6mX3ipDF81fWRGiAA8LrWZFi0qWZalpGs0yoj0H4zimVSeJbdu0lxlNK6Q9gGW/AzhIz4Ib1TI61U+r6lvN8Yf2otU2aL4vPfUuk7+WZdHrtHqdaZrIX+l6bovrC+OwBfkrCwrwUOR5nud5p9OhMZP1fX9p6wXTNGl/UNr0t5pCSgvoOI4j+x1Ar54dypbaH3Th6tDQOlmWZVk2PT29wvylTl9q9GKMYRJ/E/TM911h/o4YCvCACSGKosiyrGcRK9rdiDEWBIHnefUG56qHOE3Tsiynpqaw9W8zLcxher2n9xfVt72oSZmeYleev1SAqauYtiaU/T4m3aJpuJL8HTEU4AErioIm8i5cCqfaqZtuk+kXqHWLthE1DMP3fazb3mSL7tRdf6UhS9zB2hRFQYvhLHyKXSZ/aViWruvYd6EJetakq1sqf2VBAR4wwzBoNXYaybzw3qrKYV3XaT33qakpasvCjXMrVDlcX3WyCckM/aObYOoAXnn+drtd5G9zVHPxl6/BTVg1Ft+YwaMazDlfOF2BeJ5X32GQFnBH9rYIKu4YM03T933OeRRFi/4C8rfhqoaopdqWm5O/eAIejLIsafkbVVU1TauegxljNDyy/ss0cEN2yNCXhiQwDERZlrSShqqquq5TDaYRkTQ9of7LyN9m6hlUxTk/ZFu0dCjA/RJCxHGcZVn1Cu1lZJpmvQbLDhMAFiGEiKKovnaVqqqO41iWtUwNhkbpWfy1mn20fA1uAhTgvlT7g7quq2maoihlWdIG3TQOq6rBcrd9BoCFaIWcsiw9z6P9fcuyTJKkGoeFGtx8C5fBqU/57Zm+3zQowH1JkoRzXu8QUlXVMIwoiuI4rrdFR1FE0xigpTC/aPzQBIT6/r6Uv5SwPW3RyN8GWmZ/33oNbuxzMAYO9CXLMlqRrud16veldi3DMOj5WHawAHCQNE0dx1mYm/S8myQJY4z6kpC/zbTMUOf66w0svQRPwGtBC87RHxbdH5SGaVQzkUzTxOI4bdfYHIbVogVf6Q+LDqeinK1mIi2c0w/SraRHoCrPjU1eFOC1oASmdo+lTm1D1hoFgB6Uv7T6DfK3vcbg7KAJei1o521VVTnnlMYLLfU6AMilqiotOcc5p9mDC5VlOQbX9zG2krm8jX3wraAAr5GmaTRyMkmShTlcFEWe52h2BmgmTdN83zcMI47jRfOXhnfIDhOWUw1yPuT+3I2FArx2lMOqqlYL17EDi7kHQWAYBmbrAzSWpmmdTkdV1fn5+SzLqvzNsmx+ft40TezP3XxL1eBq927ZAR4C+oD7Qm3RtE8ZzQMWQpRlSbOPWnELBjCxVFXtdDrdbrfb7dI8YNrNjGYfIX9boT7piC222VGT4Qm4X/QcrGkaNWTRYu7IXoBWoN0UdF2npSgNw5iamup0OsjfFulZcKMt1ZehAA8EPQfrui6EME0TLc8ALUJjsgzDoNXrkL9tVNXgFlVfxpg+Ozs7pEPPzMwM6cjNjLksy263yxjzfX/h5OBmxry8CYx50YV1Gh7zMhDzymMuy5JWjXVdd9HJ/Q2MuR+IuQkx4wl4YGhMB2Os2+1Scxa0Tn3hOpgoNK+BMRaGIfIXRgMXmkGqxlW2qA0EetT7k2CiUA3GqYeRwSjoAdM0bXp6WnYU0BfcP00sGpMlOwqYFHgCBgAAkAAFGAAAQAIUYAAAAAlQgAEAACRAAQYAAJAABRgAAEACFGAAAAAJUIABAAAkQAEGAACQAAUYAABAAhRgAAAACVCAAQAAJEABBgAAkAAFGAAAQAIUYAAAAAlQgAEAACRAAQYAAJAABRgAAEACFGAAAAAJUIABAAAkQAEGAACQAAUYAABAAhRgAAAACVCAAQAAJEABBgAAkAAFGAAAQAJFCDGkQ8/Ozg7pyDMzM4gZMSNmxIyYEXOrY8YTMAAAgAQowAAAABKgAAMAAEiAAgwAACABCjAAAIAEKMAAAAASoAADAABIgAIMAAAgAQowAACABCjAAAAAEuiyA4CJIITgnDPGVFVVFEV2OACwCsjfIWlBAcb5brU8z5Mkoewluq5zzlUVrS8ATZfneZqmPflr2zbydyCaXoCr6lttGoF63BZCiDAMi6KwLMswDE3ThBBlWSZJMj8/73meYRiyYwSAxQkhoigqy9I0TV3Xq/xN0xT5OyiNLsBUa+ulVwgxvO2bYICo+pZl6fu+rutCiDzPFUUxDMMwDMdxwjCkH8mOFAB6VdXXdV3K36IoGGOUv2maIn8HornNCPXqqygKHnzbpSiKPM8pRbMs63a7aZqWZUk/tSzLtu0oinA7BdBARVEUReF5nq7reZ4HQVBviEb+Dkpz718URaHz3fMcDK2QJIllWZqmFUURx7Hruj0NVrZtZ1lWFAUasgCaJk1T0zSr/HUcB/k7DA19AqbW5uo/UX3bhcZMmqbJGEuSxLbtniylWyvDMPI8lx0sAByE8pdyNk1T5O/wNLQAQ6txzoUQmqYxxoQQPR1F1L1Er9dHVwJAE1BWVvlLf6ggfwcIBRgGr95hT8W4/lPqCe5p5ACAhkD+jkw7CjBGYLULnS9KVMuy6oM1OOdxHFPrdJ7nGEUJ0DQ9+RvHcT1/kyRB/g5KQwuwEKIa+VwfCI3h0K1A043iOGaMWZalqur8/Hwcx1EUdbtdXddN0+Scl2WJBAZoGkVRdF1PkoQxZpqmqqrdbjdJkjiOgyBA/g5QQwswO1CDqz/XX5cdGhyabdtFUWRZpiiK7/uO49AJ9TzPcRzGWBRFmqYhgQEayLKssixp7j7lLOWv67q2bTPk74A09+OrHnzpD6i77aJpmu/7QRBwzm3bNk2Tmq0YY2VZ0uu+78sOEwAWoWma67pRFNm2TSvZVQOhy7KM4xj5OxDNLcDswEOwqqqovm1kGEan06Ep/NVSlEVRlGWpKEqn00FvAkBjGYbheV4URQvzV9M05O9ANLoAM8Zo7Umc6ZbSdX16ejpNU8pbxpimabSGjuzQAOAQdF3vdDq04EaVv5ZloeV5UNrxOeIJuL0URaFOIwBoHUVRLMuyLEt2IOOpuYOwAAAAxhgKMAAAgAQowAAAABLos7OzQzr0zMzMkI6MmBEzYkbMiBkxtz1mPAEDAABIgAIMAAAgAQowAACABCjAAAAAEqAAAwAASIACDAAAIAEKMAAAgAQowAAAABKgAAMAAEjw/wP/QcGTzJTqnQAAACV0RVh0ZGF0ZTpjcmVhdGUAMjAyNC0wNi0yOFQwMzo1Nzo0MiswMDowMFdaNU8AAAAldEVYdGRhdGU6bW9kaWZ5ADIwMjQtMDYtMjhUMDM6NTc6NDIrMDA6MDAmB43zAAAAAElFTkSuQmCC";
        $datos['compania'] = 'HOTEL CASA REAL NORTE';
        $datos['nit'] = '1245126454-1';
        $datos['cliente'] = $checkin->getCliente()->getDocumentNumber().' - '.$checkin->getCliente()->getName().' '.$checkin->getCliente()->getLastname();
        $datos['telefono'] = $checkin->getCliente()->getCellphone();
        $datos['fechaServicio'] = $checkin->getFechallegada()->format('d-m-Y');

        $tabla = [];
        $total = 0;

        $servicios = [];
        $productos = [];

        foreach ($checkin->getMovimientos() as $mov) 
        {
            foreach ($mov->getDetallesmovs() as $det) 
            {
                if(!is_null($det->getServicio()))
                {
                    $servicios[$det->getServicio()->getId()][] =    [
                                                                        'concepto' => $det->getServicio()->getName().' / '.$det->getServicio()->getHours().' Horas',
                                                                        'cantidad' => 1,
                                                                        'valorUnd' =>  $det->getServicio()->getPrice(),
                                                                        'subtotal' =>  $det->getValor(),
                                                                        
                                                                    ]; 
                }

                if(!is_null($det->getProducto()))
                {
                    $productos[$det->getProducto()->getId()][] =    [
                                                                        'concepto' => $det->getProducto()->getNombre(),
                                                                        'cantidad' => $det->getCantidad(),
                                                                        'subtotal' => $det->getValor(),
                                                                        
                                                                    ];
                }
            }
        }

        foreach ($servicios as $grupoServ) 
        {
            $subtotal = 0;

            foreach ($grupoServ as $servicio)
            {
                $subtotal += $servicio['subtotal'];
            }

            $tabla[] =  [
                            'concepto' => $grupoServ[0]['concepto'],
                            'cantidad' => 1,
                            'valorUnd' => $grupoServ[0]['valorUnd'],
                            'subtotal' => $subtotal,
                                
                        ];
            
            $total += $subtotal;

        }

        foreach ($productos as $grupoProd) 
        {
            $subtotal = 0;
            $cantidad = 0;

            foreach ($grupoProd as $producto)
            {
                $subtotal += $producto['subtotal'];
                $cantidad += $producto['cantidad'];
            }

            $tabla[] =  [
                            'concepto' => $grupoProd[0]['concepto'],
                            'cantidad' => $cantidad,
                            'valorUnd' => $subtotal/$cantidad,
                            'subtotal' => $subtotal,
                                
                        ];
            
            $total += $subtotal;

        } 

        // Configure Dompdf según sus necesidades
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Helvetica')->set('sizetFont', '9')->setIsRemoteEnabled(true);

        // Crea una instancia de Dompdf con nuestras opciones
        $dompdf = new Dompdf($pdfOptions);

        $parametros = ['datos' => $datos, 'tabla' => $tabla, 'total' => $total];


        $rutaDesprendible = "formatos/factura.html.twig";
        $html = $this->renderView($rutaDesprendible, $parametros);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('letter', 'portrait');

        // Renderiza el HTML como PDF
        $dompdf->render();
        $dompdf->get_canvas()->page_text(550, 766, "Pagina: {PAGE_NUM} de {PAGE_COUNT}", 'Helvetica', 7, array(0, 0, 255));

        $PDF = base64_encode($dompdf->output());

        return new JsonResponse(['response' => 'Ok', 'pdf' => $PDF]);
    }

    public function movimientos()
    {
        $bd = $this->getDoctrine()->getManager();

        $gastos = $bd->getRepository(Gastos::class)->findBy([],['id' => 'desc']);

        return $this->render('contabilidad/listaMovimientos.html.twig', ['gastos' => $gastos]);
    }

    public function guardarBonos(Request $request)
    {
        $bd = $this->getDoctrine()->getManager();

        $beneficiario = $bd->getRepository(Persons::class)->find($request->get('beneficiarioBono'));
        $valor = str_replace(".", "", $request->get('valorBono'));
        $detalle = $request->get('detalleBono');
        $turno = $bd->getRepository(Turnos::class)->findOneBy(['status' => 1]);
        $mov = $bd->getRepository(Movimientos::class)->findOneBy(['tipo' => 1, 'estado' =>1],['id' => 'desc']);
        $usuario = $this->getUser();

        $bono = new Bonos();

        $bono->setBeneficiario($beneficiario);
        $bono->setTurno($turno);
        $bono->setUsucrea($usuario);
        $bono->setValor($valor);
        $bono->setFechacrea(new \DateTime('now', new \DateTimeZone('America/Bogota')));
        $bono->setEstado(1);
        $bono->setDetalle($detalle);

        $bd->persist($bono);

        $bd->flush();
        
        $detalles = $bd->getRepository(Detallesmov::class)->findBy(['turno' => $turno, 'mov' => $mov ],['id' => 'desc']);

        $tablaVentas = [];

        foreach ($detalles as $det) 
        {
            if(!is_null($det->getServicio()))
            {
                $producto = $det->getServicio()->getName();
            }
            else
            {
                $producto = $det->getProducto()->getCodigo().'-'.$det->getProducto()->getNombre();
            }    
            
            $tablaVentas[] = ['producto' => $producto, 'cantidad' => $det->getCantidad(),'valor' => $det->getValor() ];
        }

        $tablaMov = [];

        $detallesMov = $bd->getRepository(Detallesmov::class)->findBy(['turno' => $turno]);

        $agrupaMov = [];

        foreach ($detallesMov as $det) 
        {
            if(is_null($det->getServicio()) && is_null($det->getProducto()))
            {
                if($det->getMov()->getTipo() == 4)
                {
                    $tipoMov = 'Salidas';
                }
                else
                {
                    $tipoMov = 'Entradas';
                }
            }
            else
            {
                if(!is_null($det->getServicio()))
                {
                    if($det->getServicio()->getTipo()->getId() == 1 || $det->getServicio()->getTipo()->getId() == 2 || $det->getServicio()->getTipo()->getId() == 3)
                    {
                        $tipoMov = 'Hospedaje';
                    }
                    elseif($det->getServicio()->getTipo()->getId() == 4)
                    {
                        $tipoMov = 'Lavandería';
                    }
                }
                else
                {
                    $tipoMov = 'Tienda';
                }

            } 
            

            $agrupaMov[$tipoMov][] = ['recibido' => $det->getValor(), 'pendiente' =>  $det->getSaldo(), 'bono' => 0];
        }

        $bonos = $bd->getRepository(Bonos::class)->findBy(['turno' => $turno]);

        foreach ($bonos as $bono) 
        {
            $agrupaMov['Bonos'][] = ['recibido' => 0, 'pendiente' =>  0, 'estado' => 0, 'bono' => $bono->getValor()];
        }

        foreach ($agrupaMov as $key => $grupos) 
        {
            $valor = 0;
            $pendiente = 0;
            $bonos = 0;

            foreach ($grupos as $grupo) 
            {
                $valor += $grupo['recibido'];
                $pendiente += $grupo['pendiente'];
                $bonos += $grupo['bono'];
            }

            $tablaMov[] = ['concepto' => $key, 'valor' => $valor, 'pendiente' => $pendiente, 'bono' => $bonos];
        }

        return new JsonResponse(['tablaVentas' => $tablaVentas, 'tablaMov' => $tablaMov]);
    }

    public function bonos()
    {
        $bd = $this->getDoctrine()->getManager();

        $bonos = $bd->getRepository(Bonos::class)->findBy([],['id' => 'desc']);

        return $this->render('contabilidad/listaBonos.html.twig', ['bonos' => $bonos]);
    }

    public function cobrarBono($id)
    {
        $bd = $this->getDoctrine()->getManager();
        
        $usuario = $this->getUser();

        $bono = $bd->getRepository(Bonos::class)->find($id);

        $bono->setEstado(2);
        $bono->setUsucobro($usuario);
        $bono->setFechacobro(new \DateTime('now', new \DateTimeZone('America/Bogota')));
        
        $bd->persist($bono);

        $bd->flush();

        return new JsonResponse(['response' => 'Ok']);
    }

    public function guardarGasto(Request $request)
    {
        $bd = $this->getDoctrine()->getManager();
        
        $usuario = $this->getUser();

        $valorGasto = $request->get('valorGasto');
        $valorGasto = str_replace([".", ","], ["","."], $valorGasto);
        $tipoGasto = $request->get('tipoGasto');
        $detallesGasto = $request->get('detallesGasto');

        $gasto = new Gastos();

        $gasto->setValor($valorGasto);
        $gasto->setTipo($tipoGasto);
        $gasto->setDetalles($detallesGasto);
        $gasto->setUsucrea($usuario);
        $gasto->setFechacrea(new \DateTime('now', new \DateTimeZone('America/Bogota')));
        $gasto->setEstado(1);

        $bd->persist($gasto);

        $bd->flush();

        return new JsonResponse(['response' => 'Ok']);
    }

    public function contabilizarGasto($id)
    {
        $bd = $this->getDoctrine()->getManager();

        $gasto = $bd->getRepository(Gastos::class)->find($id);
        $gasto->setEstado(2);

        $bd->persist($gasto);

        $bd->flush();

        return new JsonResponse(['response' => 'Ok']);
    }

    public function eliminarGasto($id)
    {
        $bd = $this->getDoctrine()->getManager();

        $gasto = $bd->getRepository(Gastos::class)->find($id);
        $bd->remove($gasto);
        
        $bd->flush();

        return new JsonResponse(['response' => 'Ok']);
    }
}