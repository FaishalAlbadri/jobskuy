<?php 
    
    require_once("../config/config.php");

    $response = array();

    $result = mysqli_query($con, "SELECT * FROM project WHERE project_status = 'Waiting'");

    // variable $row untuk mengecek data di database
    $row = mysqli_num_rows($result);

    // mengecek apakah data didatabase ada isi atau kosong
    if ($row > 0) {

        // tampung array user di dalam array response
        $response['project'] = array();

        // perulangan data agar masuk ke dalam data tampungan array user
        foreach ($result as $key) {
            
            // tampung array data
            $data = array();
            $data['id_project'] = $key['id_project'];
            $data['project_title'] = $key['project_title'];
            $data['project_description'] = $key['project_description'];
            $data['project_price_low'] = $key['project_price_low'];
            $data['project_price_high'] = $key['project_price_high'];
            $data['project_image'] = $key['project_image'];

            // meng insert data ke dalam array user
            array_push($response['project'], $data);
        }
        
        $response['msg'] = "Berhasil";
        echo json_encode($response);

    } else {
        $response['msg'] = "Data Kosong";
        echo json_encode($response);
    }
?>