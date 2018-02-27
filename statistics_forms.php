<form method="POST" action="<?= $form->encode($_SERVER['PHP_SELF']) ?>">
<table>
<?php if ($errors) { ?>
<tr>
<td>You need to correct the following errors:</td>
<td><ul>
<?php foreach ($errors as $error) { ?>
<li><?= $form->encode($error) ?></li>
<?php } ?>
</ul></td>
<?php } ?>
<tr>
<td>Имя сотрудника:</td>
<td><?= $form->input('text', ['name' => 'name']) ?></td>
</tr>
<tr>
<td>Статус сотрудника:</td>
<td><?= $form->select($GLOBALS['status'],['name' => 'work']) ?></td>
</tr>
<tr>
<td>Должность сотрудника:</td>
<td><?= $form->input('text',['name' => 'status']) ?></td>
</tr>
<tr>
<td>Подразделение:</td>
<td><?= $form->select($GLOBALS['locations'],['name' => 'locations']) ?>
</td>
</tr>
<tr>
<td colspan="2" align="center">
<?= $form->input('submit', ['name' => 'search','value' => 'Search']) ?></td>
</tr>
</table>
</form>
