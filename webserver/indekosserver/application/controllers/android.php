<?php

class Android extends CI_Controller{

	public function index(){
	
	}
	
	public function route(){
		$lat = $this->uri->segment(3);
		$lng = $this->uri->segment(4);
		$lat1 = $this->uri->segment(5);
		$lng1 = $this->uri->segment(6);
		$this->load->library('googlemaps');
		$config['center'] = 'auto';
		$config['zoom'] = 'auto';
		$config['directions'] = TRUE;
		$config['directionsStart'] = '$lat, $lng';
		$config['directionsEnd'] = '$lat1, $lng1';
		$config['directionsDivID'] = 'directionsDiv';
		$this->googlemaps->initialize($config);
		$data['map'] = $this->googlemaps->create_map();
		$this->load->view('android/route', $data);
	}

}

//http://maps.google.com/maps?saddr="+srcGeoPoint.getLatitude()+","+srcGeoPoint.getLongitude()+"&daddr="+Latitude+","+Longitude

