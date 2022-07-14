    <?php
    include "koneksi.php";
    ?>
    <table id="wntable">
      <tr>
        <th>No</th>
        <th>Voltage</th>
        <th>Current</th>
        <th>Power</th>
        <th>Energy</th>
        <th>Frequency</th>
        <th>Power Factor</th>
        <th>Waktu</th>
      </tr>
    <?php
     $result = mysqli_query($connect, "SELECT * FROM datapzem ORDER BY id DESC LIMIT 10");
        if(mysqli_num_rows($result) == 0){ 
          echo '<tr><td colspan="14">Data Tidak Ada.</td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
        }else{ // jika terdapat entri maka tampilkan datanya
          $no = 1; // mewakili data dari nomor 1
        while($row = mysqli_fetch_assoc($result)){ // fetch query yang sesuai ke dalam array
          echo '
            <tr>
              <td>'.$no.'</td>
              <td>'.$row['voltage'].'</td>
              <td>'.$row['current'].'</td>
              <td>'.$row['power'].'</td>
              <td>'.$row['energy'].'</td>
              <td>'.$row['frequency'].'</td>
              <td>'.$row['powerf'].'</td>
              <td>'.$row['time'].'</td>
            </tr>
            ';
           $no++; // mewakili data kedua dan seterusnya
          }
        }
    ?>
    </table>