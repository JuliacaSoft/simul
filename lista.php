<table>
	<tr>
		<th>ID</th>
                <th>Item</th>
                <th>Opciones</th>

        </tr>
	<?php
	foreach($trabajador as $item)
	{
            
	?>
	<tr>
		<td><?php echo $item['nombre']?></td>
		<td><?php echo $item['apellidos']?></td>
                <td>
                    ver
                </td>
	</tr>
	<?php
	}
	?>
</table>

