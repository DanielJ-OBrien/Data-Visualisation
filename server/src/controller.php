<?php

class Controller{

	public function __construct(private databaseGateway $gateway){}

	public function processRequest(string $method, ?string $id): void{
		if($id){
			$this->processResourceRequest($method, $id);
		}
		else{
			$this->processCollectionRequest($method);
		}
	}

	private function processResourceRequest(string $method, string $id): void{
		$product = $this->gateway->getRecord($id);

		if (! $product){
			http_response_code(404);
			echo json_encode(["message" => "Data not found"]);
			return;
		}

		switch ($method){
			case "GET":
				echo json_encode($product);
				break;
			
			case "PATCH":
				$data = (array) json_decode(file_get_contents("php://input"), true);
				$errors = $this->getValidationErrors($data);

				if (! empty($errors)){
					http_response_code(422);
					echo json_encode(["Errors:" => $errors]);
					break;
				}
				
				$rows = $this->gateway->updateRecord($product, $data);
				echo json_encode([
					"message" => "Data updated",
					"rows" => $rows
				]);
				break;

			case "DELETE":
				$rows = $this->gateway->deleteRecord($id);

				echo json_encode([
					"message" => "Data deleted",
					"rows" => $rows
				]);
				break;
			default:
				http_response_code(405);
				header("Allow: GET, PATCH, DELETE");
		}

		
	}

	private function processCollectionRequest(string $method){
		switch ($method){
			case "GET":
				echo json_encode($this->gateway->getAll());
				break;
			
			case "POST":
				$data = (array) json_decode(file_get_contents("php://input"), true);
				$errors = $this->getValidationErrors($data);

				if (! empty($errors)){
					http_response_code(422);
					echo json_encode(["Errors:" => $errors]);
					break;
				}
				
				$id = $this->gateway->addRecord($data);
				http_response_code(201);
				echo json_encode([
					"message" => "Data added",
					"id" => $data["id"]
				]);
				break;
		
			default:
			http_response_code(405);
			header("Allow: GET, POST");
		}
	}

	private function getValidationErrors(array $data): array{
		$errors = [];

		$stringVariables = [
			"parent1", "home_val", "mstatus", "gender", "education", "occupation",
			"car_use", "bluebook", "car_type", "red_car", "oldclaim", "revoked",
			"clm_amt", "car_age", "urbanicity"
		];
	
		foreach ($stringVariables as $variable) {
			if (!isset($data[$variable]) || trim($data[$variable]) === "") {
				$errors[] = "No {$variable} provided.";
			}
		}

		$numericVariables = [
			"id", "kidsdriv", "age", "homekids", "travtime", "tif",
			"clm_freq", "mvr_pts", "claim_flag"
		];
	
		foreach ($numericVariables as $variable) {
			if (!isset($data[$variable]) || !is_numeric($data[$variable]) || !ctype_digit($data[$variable])) {
				$errors[] = "No {$variable} provided or not an integer.";
			}
		}

		return $errors;
	}
}