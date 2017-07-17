<?php

require_once 'controllers/RoutesController.php';

class GA {

	public $points;
	public $populationSize;
	public $Population = array();
	public $crossPopulation = array();

	public function __construct() {
		$this->route = new RoutesController();
	}

	public function createDistanceMatrix() {
		$states = $this->Coordinates;
		for ($i=0; $i < sizeof($states); $i++) { 
			for ($j=0; $j < sizeof($states); $j++) { 	
				$start = json_decode($states[$i]);
				$end = json_decode($states[$j]);	
				if($i > $j) {	
					$endPosition = $end[2]->Lng.",".$end[1]->Lat;		
					$startPosition = $start[2]->Lng.",".$start[1]->Lat;
					$json = self::getDistance($startPosition, $endPosition);				
					$this->distanceMatrix[$i][$j] = $json->rows[0]->elements[0]->distance->text;
					$this->distanceMatrix[$j][$i] = $json->rows[0]->elements[0]->distance->text;
				}
			}
		}
	}

	public function getDistance($start, $end) {
		$url = "https://maps.google.com/maps/api/distancematrix/json?origins=".$start."&destinations=".$end."&sensor=false&key=AIzaSyB_KLkzSp2F1whEipxRAVpZ7RyKP5CWih0";
		// var_dump($url);
		return json_decode(file_get_contents($url));
	}

	public function main() {

		$stopCounter = 0;
		$previousPath = 0;
		$this->createDistanceMatrix();
		$this->CreateFisrtPupulation();
		$this->populationSize = sizeof($this->Population);	
		while($stopCounter < 5) {
			$this->Crossover();
			$this->Mutation();
			$this->Selection();
			$minDistance = min(array_column($this->Population, 1));	
			// var_dump($minDistance);
			if($previousPath == $minDistance) {
				$stopCounter++;
			} else {
				$previousPath = $minDistance;
				$stopCounter = 0;
			}
		}
		$this->showMap();
	}
	

	public function showMap() {

		$res = $this->Population[0][0];
		$tmp = "0"; $result = []; $points = [];
		for ($i=0; $i < sizeof($res); $i++) { 
			array_push($result, array($this->distanceMatrix[$tmp][$res[$i]], $res[$i]));
			$tmp = $res[$i];
		}
		$getStartEndPoint = json_decode($this->Coordinates[0]);
		$start = $getStartEndPoint[0];
		$end = $getStartEndPoint[0];
		foreach ($result as $key => $value) {
			if($key != 0) {          
				$placeWaypoint = json_decode($this->Coordinates[$value[1]]);
				array_push($points, $placeWaypoint[2]->Lng.",".$placeWaypoint[1]->Lat);
			}
		}

		$url = "https://www.google.com/maps/embed/v1/directions?key=AIzaSyCsJ_XkaVcu2NvTkaDbkN5U_2yo65nWSxQ&origin=".$start."&destination=".$end."&waypoints=".implode("|", $points);
		
		echo "<iframe width='100%' height='500' frameborder='0'src='$url' allowfullscreen> </iframe>";
		echo
		"
		<table class='table'> 
			<tr> 
				<td>From</td> 
				<td>To</td> 
				<td>Distance</td> 
			</tr>";
			for ($i= 1; $i < sizeof($result); $i++) {  
				$start = json_decode($this->Coordinates[$result[$i - 1][1]]);
				$end = json_decode($this->Coordinates[$result[$i][1]]);
				echo 
				"
				<tr>
					<td>".$start[0]."</td>
					<td>".$end[0]."</td> 
					<td>".$result[$i][0]."</td>
				</tr>
				";
			}
			echo 
			"
		</table>
		";
		$this->points = json_encode($points);
	}

	public function Selection() {

		$counter = 0;
		$newPopulation = array();
		$size = sizeof($this->Population);
		foreach ($this->Population as $key => $value) {
			$first = $this->Population[rand(0, $size - 1)];
			$second =$this->Population[rand(0, $size - 1)];
			if($counter < $this->populationSize) {
				if($first[1] <= $second[1]) {
					array_push($newPopulation, $first);
					$counter++;
				} else {
					array_push($newPopulation, $second);
					$counter++;
				}
			}
		}
		foreach ($this->Population as $key => $value) {
			for ($i=0; $i < sizeof($value[0]); $i++) { 
			}
		}
		return $this->Population = $newPopulation;
	}

	public function mutation() {

		$pop = $this->Population[0][0];	
		foreach ($pop as $key => $chromosome) {
			if(rand(0, 100) <= 5) {		
				$firstGen = rand(1, sizeof($pop) - 2);
				$secondGen = rand(1, sizeof($pop) - 2);
				$bufFirst = $pop[$firstGen - 1];
				$bufSecond = $pop[$secondGen - 1];
				$pop[$firstGen - 1] = $bufSecond;
				$pop[$secondGen - 1] = $bufFirst;
			}
		}
	}

	public function Crossover() {

		foreach ($this->Population as $key => $chromosome) {
			if(rand(0, 100) <= 100) {	
				array_push($this->crossPopulation, $chromosome);
			}
		}
		for ($i=0; $i < sizeof($this->crossPopulation) ; $i++) { 
			if($i % 2) {
				$childs = $this->startCrossing(
					$this->crossPopulation[$i -1][0],
					$this->crossPopulation[$i][0]
					);
				$this->getChromosomeFitnessFunction($childs[0]);
				$this->getChromosomeFitnessFunction($childs[1]);
			}
		}
		return $this->crossPopulation = [];
	}

	public function startCrossing($parentOne, $parentTwo) {

		$child1 = $this->returnCrossingResult($parentOne, $parentTwo);
		$child2 = $this->returnCrossingResult($parentTwo, $parentOne);	
		return [$child1, $child2];
	}

	public function returnCrossingResult($firstParent, $secondParent) {

		$left = [];
		$chromosome = [];	
		array_push($chromosome, "0");
		for ($i = 1; $i < sizeof($firstParent) - 1; $i++) { 
			if(!in_array($firstParent[$i], $chromosome) && !in_array( $firstParent[$i] , $left)) {
				array_push($chromosome, $firstParent[$i]);
				for ($j = sizeof($secondParent) - 2; $j > 0; $j--) { 
					if(!in_array( $secondParent[$j] , $chromosome) && !in_array( $secondParent[$j] , $left)) {
						array_push($left, $secondParent[$j]);
						break;
					}
				}
			}
		}
		$chromosome = array_merge ($chromosome,array_reverse($left));
		array_push($chromosome, "0");
		return $chromosome;
	}

	public function CreateFisrtPupulation() {

		for ($i = 0; $i < $this->populationSize; $i++) {
			$this->getChromosomeFitnessFunction( $this->randomGenome() );
		}

	}

	public function getChromosomeFitnessFunction($chromosome){

		$distance = 0;
		for ($i = 1; $i < sizeof($chromosome); $i++)
			$distance += $this->distanceMatrix[$chromosome[$i - 1]][$chromosome[$i]];	
		return array_push($this->Population, array($chromosome, $distance));
	}

	public function randomGenome() {

		$chromo = array();
		$size = sizeof($this->distanceMatrix) - 1;
		$num = explode(",","1,2,3,4,5,6,7,8,9,10,11,12,13, 14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30");
		array_push($chromo, "0"); 
		$randCount = $size+1; 
		$randMin = 1; 
		$randMax = $size; 
		$randArray = array(); 
		while (true) { 
			$rand = rand($randMin, $randMax); 
			if (!in_array($rand, $randArray)) { 
				$randArray[] = $rand; 
				array_push($chromo, $num[$rand-1]); 
				if (sizeof($randArray) + 1 == $randCount) { 
					break; 
				}
			}
		}
		array_push($chromo, "0"); 
		return $chromo;
	}
}