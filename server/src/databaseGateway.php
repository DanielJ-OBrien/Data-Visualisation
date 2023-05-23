<?php

class DatabaseGateway{
	private PDO $conn;
	public function __construct(Database $database){
		$this->conn = $database->getConnection();
	}

	public function getAll(): array{
		$sql = "SELECT * FROM car_insurance_claim";
		$statement = $this->conn->query($sql);
		$data = [];

		while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
			$data[] = $row;
		}

		return $data;
	}

	public function addRecord(array $data): string{
		$sql = "INSERT INTO car_insurance_claim (IDS, KIDSDRIV, BIRTH, AGE, HOMEKIDS, YOJ, INCOME, PARENT1, HOME_VAL, MSTATUS, GENDER, EDUCATION, OCCUPATION, TRAVTIME, CAR_USE, BLUEBOOK, TIF, CAR_TYPE, RED_CAR, OLDCLAIM, CLM_FREQ, REVOKED, MVR_PTS, CLM_AMT, CAR_AGE, CLAIM_FLAG, URBANICITY)
		VALUES (:id, :kidsdriv, :birth, :age, :homekids, :yoj, :income, :parent1, :home_val, :mstatus, :gender, :education, :occupation, :travtime, :car_use, :bluebook, :tif, :car_type, :red_car, :oldclaim, :clm_freq, :revoked, :mvr_pts, :clm_amt, :car_age, :claim_flag, :urbanicity)";

		$statement = $this->conn->prepare($sql);

		$statement->bindValue(":id", $data["id"], PDO::PARAM_INT);
		$statement->bindValue(":kidsdriv", $data["kidsdriv"], PDO::PARAM_INT);
		$statement->bindValue(":birth", $data["birth"], PDO::PARAM_STR);
		$statement->bindValue(":age", $data["age"], PDO::PARAM_INT);
		$statement->bindValue(":homekids", $data["homekids"], PDO::PARAM_INT);
		$statement->bindValue(":yoj", $data["yoj"], PDO::PARAM_STR);
		$statement->bindValue(":income", $data["income"], PDO::PARAM_STR);
		$statement->bindValue(":parent1", $data["parent1"], PDO::PARAM_STR);
		$statement->bindValue(":home_val", $data["home_val"], PDO::PARAM_STR);
		$statement->bindValue(":mstatus", $data["mstatus"], PDO::PARAM_STR);
		$statement->bindValue(":gender", $data["gender"], PDO::PARAM_STR);
		$statement->bindValue(":education", $data["education"], PDO::PARAM_STR);
		$statement->bindValue(":occupation", $data["occupation"], PDO::PARAM_STR);
		$statement->bindValue(":travtime", $data["travtime"], PDO::PARAM_INT);
		$statement->bindValue(":car_use", $data["car_use"], PDO::PARAM_STR);
		$statement->bindValue(":bluebook", $data["bluebook"], PDO::PARAM_STR);
		$statement->bindValue(":tif", $data["tif"], PDO::PARAM_INT);
		$statement->bindValue(":car_type", $data["car_type"], PDO::PARAM_STR);
		$statement->bindValue(":red_car", $data["red_car"], PDO::PARAM_STR);
		$statement->bindValue(":oldclaim", $data["oldclaim"], PDO::PARAM_STR);
		$statement->bindValue(":clm_freq", $data["clm_freq"], PDO::PARAM_INT);
		$statement->bindValue(":revoked", $data["revoked"], PDO::PARAM_STR);
		$statement->bindValue(":mvr_pts", $data["mvr_pts"], PDO::PARAM_INT);
		$statement->bindValue(":clm_amt", $data["clm_amt"], PDO::PARAM_STR);
		$statement->bindValue(":car_age", $data["car_age"], PDO::PARAM_STR);
		$statement->bindValue(":claim_flag", $data["claim_flag"], PDO::PARAM_INT);
		$statement->bindValue(":urbanicity", $data["urbanicity"], PDO::PARAM_STR);

		$statement->execute();

		return $this->conn->lastInsertId();
	}

	public function getRecord(string $id): array | false{

		$sql = "SELECT * FROM car_insurance_claim WHERE IDS = :id";
		$statement = $this->conn->prepare($sql);
		$statement->bindValue(":id", $id, PDO::PARAM_INT);
		$statement->execute();
		$data = $statement->fetch(PDO::FETCH_ASSOC);
		return $data;
	}

	public function updateRecord(array $current, array $new): int{
		$sql = "UPDATE car_insurance_claim
        SET IDS = :id, KIDSDRIV = :kidsdriv, BIRTH = :birth, AGE = :age, HOMEKIDS = :homekids, YOJ = :yoj, INCOME = :income, PARENT1 = :parent1, HOME_VAL = :home_val, MSTATUS = :mstatus, GENDER = :gender, EDUCATION = :education, 
        OCCUPATION = :occupation, TRAVTIME = :travtime, CAR_USE = :car_use, BLUEBOOK = :bluebook, TIF = :tif, CAR_TYPE = :car_type, RED_CAR = :red_car, OLDCLAIM = :oldclaim, CLM_FREQ = :clm_freq, REVOKED = :revoked, MVR_PTS = :mvr_pts, CLM_AMT = :clm_amt, 
        CAR_AGE = :car_age, CLAIM_FLAG = :claim_flag, URBANICITY = :urbanicity
        WHERE IDS = :id";
		$statement = $this->conn->prepare($sql);

		$statement->bindValue(":id", $new["id"] ?? $current["id"], PDO::PARAM_INT);
		$statement->bindValue(":kidsdriv", $new["kidsdriv"] ?? $current["kidsdriv"], PDO::PARAM_INT);
		$statement->bindValue(":birth", $new["birth"] ?? $current["birth"], PDO::PARAM_STR);
		$statement->bindValue(":age", $new["age"] ?? $current["age"], PDO::PARAM_INT);
		$statement->bindValue(":homekids", $new["homekids"] ?? $current["homekids"], PDO::PARAM_INT);
		$statement->bindValue(":yoj", $new["yoj"] ?? $current["yoj"], PDO::PARAM_STR);
		$statement->bindValue(":income", $new["income"] ?? $current["income"], PDO::PARAM_STR);
		$statement->bindValue(":parent1", $new["parent1"] ?? $current["parent1"], PDO::PARAM_STR);
		$statement->bindValue(":home_val", $new["home_val"] ?? $current["home_val"], PDO::PARAM_STR);
		$statement->bindValue(":mstatus", $new["mstatus"] ?? $current["mstatus"], PDO::PARAM_STR);
		$statement->bindValue(":gender", $new["gender"] ?? $current["gender"], PDO::PARAM_STR);
		$statement->bindValue(":education", $new["education"] ?? $current["education"], PDO::PARAM_STR);
		$statement->bindValue(":occupation", $new["occupation"] ?? $current["occupation"], PDO::PARAM_STR);
		$statement->bindValue(":travtime", $new["travtime"] ?? $current["travtime"], PDO::PARAM_INT);
		$statement->bindValue(":car_use", $new["car_use"] ?? $current["car_use"], PDO::PARAM_STR);
		$statement->bindValue(":bluebook", $new["bluebook"] ?? $current["bluebook"], PDO::PARAM_STR);
		$statement->bindValue(":tif", $new["tif"] ?? $current["tif"], PDO::PARAM_INT);
		$statement->bindValue(":car_type", $new["car_type"] ?? $current["car_type"], PDO::PARAM_STR);
		$statement->bindValue(":red_car", $new["red_car"] ?? $current["red_car"], PDO::PARAM_STR);
		$statement->bindValue(":oldclaim", $new["oldclaim"] ?? $current["oldclaim"], PDO::PARAM_STR);
		$statement->bindValue(":clm_freq", $new["clm_freq"] ?? $current["clm_freq"], PDO::PARAM_INT);
		$statement->bindValue(":revoked", $new["revoked"] ?? $current["revoked"], PDO::PARAM_STR);
		$statement->bindValue(":mvr_pts", $new["mvr_pts"] ?? $current["mvr_pts"], PDO::PARAM_INT);
		$statement->bindValue(":clm_amt", $new["clm_amt"] ?? $current["clm_amt"], PDO::PARAM_STR);
		$statement->bindValue(":car_age", $new["car_age"] ?? $current["car_age"], PDO::PARAM_STR);
		$statement->bindValue(":claim_flag", $new["claim_flag"] ?? $current["claim_flag"], PDO::PARAM_INT);
		$statement->bindValue(":urbanicity", $new["urbanicity"] ?? $current["urbanicity"], PDO::PARAM_STR);

		$statement->execute();
		return $statement->rowCount();
	}

	public function deleteRecord(string $id): int{
		$sql = "DELETE FROM car_insurance_claim WHERE IDS = :id";
		$statement = $this->conn->prepare($sql);
		$statement->bindValue(":id", $id, PDO::PARAM_INT);
		$statement->execute();
		return $statement->rowCount();
	}
}