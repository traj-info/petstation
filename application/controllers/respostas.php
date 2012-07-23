<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Respostas extends CI_Controller {

	public function pending()
	{
		// TODO: get current logged in user
		$id = '69';
	
		$a = new Resposta();
		$a->where('author_id', $id)->get();
		$data['total'] = $a->result_count();
		
		if($data['total'] > 0)
		{
			foreach($a as $r)
			{
				$r->avaliacao->get();
				$r->ref_user->get();
				$r->controle->get();
				
				$data['resp'][] = array(
					'id' => $r->id,
					'titulo' => $r->avaliacao->name,
					'referente' => $r->ref_user->nome,
					'referente_id' => $r->ref_user->id,
					'status' => traduz_status_resposta($r->status_id),
					'status_id' => $r->status_id,
					'mes' => traduz_mes($r->controle->ref_mes) . '/' . obter_ano($r->controle->ref_mes)
				);
			}
			$data['resp'] = arrayToObject($data['resp']);
		}
		else
		{
			$data['resp'] = NULL;
		}
	
		$data['title'] = 'Avaliações para preencher';
		$this->load->view('view_respostas', $data);
	}
	
	public function about_me()
	{
	
	}

	public function index()
	{
		$this->pending();
	}

	public function answer()
	{
		// TODO: checar se usuário logado pode preencher esta avaliação
	
		$id = $this->uri->segment(3);
		$r = new Resposta($id);
		if($r->result_count() < 1)
		{
			redirect(base_url('respostas/pending'));
		}
		
		$r->avaliacao->get();
		$r->ref_user->get();
		$r->author->get();
		$r->controle->get();
		
		$data['id'] = $id;
		$data['open_as'] = $r->open_as;

		$data['r'] = $r;
		$data['avaliacao'] = $r->avaliacao;
		$data['ref_user'] = $r->ref_user;
		$data['author'] = $r->author;
		$data['controle'] = $r->controle;
		
		$data['title'] = 'Preencher avaliação: [' . $r->avaliacao->name . ']';
		
		$this->load->view('view_questionario', $data);
	}
	

}

