<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct(){

		parent::__construct();

		$this->load->helper('url');
		$this->load->helper('download');
		$this->load->helper('file');
		$this->load->helper('array');
		
	}


	public function index(){

		$this->load->view('home');

	}

	public function gerarArquivo(){

		$data['nome'] = $this->input->post('nome');
		$data['email'] = $this->input->post('email');
		$data['cidade'] = $this->input->post('cidade');
		$data['bairro'] = $this->input->post('bairro');

		$path = "./uploads/";

		if(!is_dir($path)) {
			mkdir($path, 0777, $recursive = true);
		}

		$xml = array(

			'header' => '<?xml version="1.0" encoding="UTF-8"?>',
			'main' => '<dados>',
			'nome' => '<nome>'.$data['nome'].'</nome>',
			'email' => '<email>'.$data['email'].'</email>',
			'cidade' => '<cidade>'.$data['cidade'].'</cidade>',
			'bairro' => '<bairro>'.$data['bairro'].'</bairro>',
			'endMain' => '</dados>'

		);

		file_put_contents($path.$data['nome'].'.xml', $xml);
		// Salvo o arquivo no diretório

		$file = file_get_contents($path.$data['nome'].'.xml');
		// Leio o diretório e recupero o arquivo

		unlink($path.$data['nome'].'.xml');
		// apago o arquivo do diretório

		force_download($data['nome'].'.xml', $file);
		// Faço o download passando o nome e a variável do arquivo como parâmetro

	}

}
