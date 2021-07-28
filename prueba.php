<?php
$fecha = DateTime::createFromFormat('d/m/Y', '21/06/2016');
$hola=$fecha->format('Y-m-d');
echo $hola;
?>

<table id="table" class="table">
                    <thead class="table-dark">
                        <th>Descripción</th>
                    </thead>
                    <tbody>
                        <?php
                        if ($row = mysqli_fetch_assoc($busqueda)) {?>
                        <tr>
                            <td>
                                <?php 
                                    echo $row['DES_CUR'];
                                ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>