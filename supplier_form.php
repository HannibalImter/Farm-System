<?php
    // session_start();
    include "UI_include.php";
    include INC_DIR."/process/p-login.php";
    include INC_DIR.'header.html';
    include_once 'includes/classes/Supplier.php';
?>

<header class="header">
  <h1 class="logo"><a href="#">My Farm Mangment system</a></h1>
  <ul class="main-nav">
  </ul>
</header>
<style>
*{
  box-sizing: border-box;
}
.suppliesTable {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

.suppliesTable td, .suppliesTable th {
  border: 1px solid #ddd;
  padding: 8px;
}

.suppliesTable tr:nth-child(even){background-color: #f2f2f2;}

.suppliesTable tr:hover {background-color: #ddd;}

.suppliesTable th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
.heading{
  margin: auto;
  width: 50%;
  border: 2px solid green;
  padding: 10px;
  text-align: center;
}

</style>
<script src="js-files/w3.js"></script>

<body>

  <br>
  <h2 class="heading">All Farm Suppliers</h2>
  <table id="supplierDisplay" class="suppliesTable">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Phone</th>
      <!-- <th>Delete</th> -->
    </tr>
    <tr w3-repeat="suppliers">
      <td>{{id}}</td>
      <td>{{name}}</td>
      <td>{{phone}}</td>
      <!-- <th>{{deleteID}}</th> -->
    </tr>
  </table>

  <br>
  <form action="/p-insertSupllier.php">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name">
    <label for="phone">Phone Number:</label>
    <input type="text" id="phone" name="phone">
    <input type="submit" value="Submit">
  </form>


</body>

<?php
$suppliers = new Supplier();
$phpSuppliers = $suppliers->getAllSuppliers();
?>
<script>
  const phpSuppliers = '<?php echo json_encode($phpSuppliers); ?>';
  const suppliersObjArray = Object.values(JSON.parse(phpSuppliers));
  w3.displayObject("supplierDisplay", {"suppliers": suppliersObjArray});


  // let myObject = {"suppliers": [
  //   {"id": 1, "name": "ahmed", "phone": "0921111111", "deleteID": 12},
  //    {"id": 2, "name": "mohammed", "phone": "0922222222", "deleteID": 12},
  //     {"id": 3, "name": "hani", "phone": "092133333", "deleteID": 12}
  //   ]
  // };
</script>


</html>