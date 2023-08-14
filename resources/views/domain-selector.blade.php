<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Branches Dropdown</title>
    <!-- Include Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body>
    <label for="branches">Select a Branch:</label>
    <div class="row">
        <div class="col-sm-12 form-group">
            <label class="form-label-bold">Jenis</label>
            <select class="select2 form-control" id="type" required>

        <?php
        $curl_handle = curl_init();

        $url = "https://secure.disoft-tech.com/Disoft_RestFul_Api/resources/Sawa_Api/S1_Branches?pUName=10921372&pUToken=fvoxk8djufcpez8dus91vacy5dp19jza&pB_Userid=34&pCompanyid=2";

        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);

        $curl_data = curl_exec($curl_handle);
        curl_close($curl_handle);

        $response_data = json_decode($curl_data);
        $user_data = $response_data->S_BRANCHESLIST;

        foreach ($user_data as $user) {
            echo '<option value="' . $user->DB_BRANCH_NAME_AR . '">' . $user->DB_BRANCH_NAME_AR . '</option>';
        }
        ?>
               
            </select>
        </div>
    </div>

   
    

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2({});
        });
    </script>
</body>
</html>
