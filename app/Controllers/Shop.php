<?php

namespace App\Controllers;

class Shop extends BaseController
{
    private $url = "https://api.rajaongkir.com/starter/";
	private $apiKey = "ae4b0421f38dd6cd9ae8bc74a55b76e1";

    public function __construct()
	{ 
        helper('form'); 
		$this->session = session();
	}

	public function index()
	{
		$barangModel = new \App\Models\BarangModel();
        $kategoriModel = new \App\Models\KategoriModel();
		$barang = $barangModel->select('barang.*, kategori.nama AS kategori')->join('kategori', 'barang.id_kategori=kategori.id')->findAll();
        $kategori = $kategoriModel->findAll();
		return view('shop/index',[
			'barangs' => $barang,
            'kategoris' => $kategori,
		]);
	}

    public function category()
	{
		$id = $this->request->uri->getSegment(3);

		$barangModel = new \App\Models\BarangModel(); 
        $kategoriModel = new \App\Models\KategoriModel();
		$barang = $barangModel->select('barang.*, kategori.nama AS kategori')->where('id_kategori', $id)->join('kategori', 'barang.id_kategori=kategori.id')->where('id_kategori', $id)->findAll(); 
        $kategori = $kategoriModel->findAll();
		return view('shop/index',[
			'barangs' => $barang, 
            'kategoris' => $kategori,
		]);
	} 

    public function product()
	{
		$id = $this->request->uri->getSegment(3);

		$barangModel = new \App\Models\BarangModel(); 
        $kategoriModel = new \App\Models\KategoriModel();
        $komentarModel = new \App\Models\KomentarModel();
		$barang = $barangModel->find($id); 
        $kategori = $kategoriModel->findAll();
        $komentar = $komentarModel->select('komentar.*, user.username')->where('id_barang', $id)->join('user', 'komentar.id_user=user.id')->where('id_barang', $id)->findAll();

		$provinsi = $this->rajaongkir('province');
        
		return view('shop/product',[
			'barang' => $barang, 
            'kategoris' => $kategori,
            'komentars' => $komentar,
            'provinsi'=> json_decode($provinsi)->rajaongkir->results,
		]);
	}
    
    public function getCity()
	{
		if ($this->request->isAJAX()){
			$id_province = $this->request->getGet('id_province');
			$data = $this->rajaongkir('city', $id_province);
			return $this->response->setJSON($data);
		}
	}

	public function getCost()
	{
		if ($this->request->isAJAX()){
			$origin = $this->request->getGet('origin');
			$destination = $this->request->getGet('destination');
			$weight = $this->request->getGet('weight');
			$courier = $this->request->getGet('courier');
			$data = $this->rajaongkircost($origin, $destination, $weight, $courier);
			return $this->response->setJSON($data);
		}
	}

	private function rajaongkircost($origin, $destination, $weight, $courier)
	{

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "origin=".$origin."&destination=".$destination."&weight=".$weight."&courier=".$courier,
		  CURLOPT_HTTPHEADER => array(
		    "content-type: application/x-www-form-urlencoded",
		    "key: ".$this->apiKey,
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		return $response;
	}


	private function rajaongkir($method, $id_province=null)
	{
		$endPoint = $this->url.$method;

		if($id_province!=null)
		{
			$endPoint = $endPoint."?province=".$id_province;
		}

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $endPoint,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "key: ".$this->apiKey
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		return $response;
	} 

	public function addWishList(){
		$id = $this->request->getPost('id');
		$wishlist = $this->request->getCookie('wishlist');
		$wishlist = $wishlist ? json_decode($wishlist, true) : [];
		if(!in_array($id, $wishlist)){
			$wishlist[] = $id;
		}else{
			$wishlist = array_diff($wishlist, [$id]);
		}
		$wishlist = json_encode($wishlist);
		$this->response->setCookie('wishlist', $wishlist, time()+3600*24*30);
		return $this->response->setJSON(['status' => 200]);
	}
	
	

	public function getWishList()
	{
		$wishlist = $this->request->getCookie('wishlist');
		$wishlist = $wishlist ? json_decode($wishlist, true) : [];
		$barangModel = new \App\Models\BarangModel();
		if (count($wishlist) > 0) {
			$barang = $barangModel->whereIn('id', $wishlist)->findAll();
			$kategoriModel = new \App\Models\KategoriModel();
			$kategori = $kategoriModel->whereIn('id', array_column($barang, 'id_kategori'))->findAll();
			return view('shop/wishlist', [
				'wishlist' => $barang,
				'kategori' => $kategori,
			]);
		}else{
			return view('shop/wishlist', [
				'wishlist' => [],
				'kategori' => [],
			]);
		}
	
	}

	public function removewishlist()
	{

		$id = $this->request->getPost('id');
		$wishlist = $this->request->getCookie('wishlist');
		$wishlist = $wishlist ? json_decode($wishlist, true) : [];
		$wishlist = array_diff($wishlist, [$id]);
		$wishlist = json_encode($wishlist);
		$this->response->setCookie('wishlist', $wishlist, time()+3600*24*30);
		return $this->response->redirect(site_url('shop/wishlist'));
	}

}