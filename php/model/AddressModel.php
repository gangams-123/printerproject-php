<?php
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../api/debug.log');
class AddressModel {
    public function saveAddress($conn, $data, $entityType, $type, $id) {
          error_log("=== in saveAddress AddressModel===");
        // Extract values safely (adjust fields as needed)
        $addressLine = mysqli_real_escape_string($conn, $data->inputAddress);
        $city        = mysqli_real_escape_string($conn, $data->city);
        $state       = mysqli_real_escape_string($conn, $data->state);
        $postalCode  = mysqli_real_escape_string($conn, $data->zip);
        $country     = mysqli_real_escape_string($conn, $data->selectedCountry);

        $sql = "INSERT INTO addresses (address_line, city, state, postal_code, country, entity_type, entity_id, type, created_at, createdBy)
                VALUES ('$addressLine', '$city', '$state', '$postalCode', '$country', '$entityType', $id, '$type', NOW(), 'ganga')";
         mysqli_query($conn, $sql);
       
    }
}
?>
