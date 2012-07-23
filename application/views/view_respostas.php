<?php $this->load->view('header'); ?>
<?php $this->load->view('respostas_opcoes'); ?>
<?php echo ($this->input->get('msg') && $this->input->get('msg_type'))? msg(urldecode(html_entity_decode($this->input->get('msg', TRUE))), urldecode(html_entity_decode($this->input->get('msg_type', TRUE)))) : ''; ?>
<h2><?php echo $title; ?></h2>

<script type="text/javascript">
function confirmar_delete(url, id, nome)
{
	$msg = "Tem certeza de que deseja excluir o modelo de avaliação " + nome + " (ID: " + id + ")? Todos os registros vinculados a ele, dados de produção, avaliações, etc. também serão excluídos.";
	if(confirm($msg))
	{
		window.location.href = url;
	}
}

</script>

<?php
if($total > 0)
{
	echo "<table id='view_respostas' class='tabela1 tabela_estilo1'>";
	echo "<thead>";
	echo "<tr>";
	echo "<th>ID</th>";
	echo "<th>Título</th>";
	echo "<th>Referente a</th>";
	echo "<th>Mês de referência</th>";
	echo "<th>Status</th>";
	echo "<th>Opções</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";
	
	foreach($resp as $i => $u)
	{
		echo "<tr id='" . $u->id . "'>";
		echo "<td>" . $u->id . "</td>";
		echo "<td>" . $u->titulo . "</td>";
		echo "<td>" . $u->referente . "</td>";
		echo "<td>" . $u->mes . "</td>";
		echo "<td>" . $u->status . "</td>";
		echo "<td><ul class='view_opcoes'>";
		echo "<li class='op_preencheravaliacao'><a title='Preencher avaliação' href='" . base_url('respostas/answer/' . $u->id) . "'>Preencher avaliacao</a></li>";
		echo "</ul></td>";
		
		echo "</tr>";
	}
	echo "</table>";
}
else
{
	echo "<p>Nenhuma avaliação encontrada.</p>";
}

?>
<?php $this->load->view('footer'); ?>