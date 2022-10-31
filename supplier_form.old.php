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

  /* Css For The insert Form */

  .container{
    border-radius: 10px;
    background-color: #13c555;
    padding: 20px;
  }

  body {
          font-family: Arial, Helvetica, sans-serif;
  }

  .form-inline {
      display: flex;
      flex-flow: row wrap;
      align-items: center;
  }

  .form-inline label {
      margin: 5px 10px 5px 0;
  }

  .form-inline input {
      vertical-align: middle;
      margin: 5px 10px 5px 0;
      padding: 10px;
      background-color: #fff;
      border: 1px solid #ddd;
  }

  .form-inline button {
      padding: 10px 20px;
      background-color: dodgerblue;
      border: 1px solid #ddd;
      color: white;
      cursor: pointer;
  }

  .form-inline button:hover {
      background-color: royalblue;
  }

  @media (max-width: 800px) {
    .form-inline input {
      margin: 10px 0;
    }

    .form-inline {
      flex-direction: column;
      align-items: stretch;
    }
  }

  /* Dropdown select css */
  /*the container must be positioned relative:*/
  .custom-select {
    position: relative;
    font-family: Arial;
  }

  .custom-select select {
    display: none;
  }

  .select-selected {
    background-color: DodgerBlue;
    
  }

  /*style the arrow inside the select element:*/
  .select-selected:after {
    position: absolute;
    content: "";
    top: 14px;
    right: 10px;
    width: 0;
    height: 0;
    border: 6px solid transparent;
    border-color: #fff transparent transparent transparent;
  }

  /*point the arrow upwards when the select box is open (active):*/
  .select-selected.select-arrow-active:after {
    border-color: transparent transparent #fff transparent;
    top: 7px;
  }

  /*style the items (options), including the selected item:*/
  .select-items div,.select-selected {
    color: #ffffff;
    padding: 0px 16px;
    border: 1px solid transparent;
    border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
    cursor: pointer;
    user-select: none;
  }

  /*style items (options):*/
  .select-items {
    position: absolute;
    background-color: DodgerBlue;
    top: 100%;
    left: 0;
    right: 0;
    z-index: 99;
  }

  /*hide the items when the select box is closed:*/
  .select-hide {
    display: none;
  }

  .select-items div:hover, .same-as-selected {
    background-color: rgba(0, 0, 0, 0.1);
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
    </tr>
    <tr w3-repeat="suppliers">
      <td>{{id}}</td>
      <td>{{name}}</td>
      <td>{{phone}}</td>
    </tr>
  </table>

  <br>
  <div class="container">
    <form class="form-inline" method="POST" action="includes/process/p-supplier.php">
      <input name="addForm" value="true" style="display: none"></input>
      <label for="name">Supplier Name:</label>
      <input type="name" id="sName" placeholder="Supplier Name..." name="sName" required>
      <label for="phone">Supplier phone:</label>
      <input type="phone" id="phone" placeholder="Supplier phone..." name="phone" required>
      <button type="submit">Add Supplier</button>
    </form>
  </div>
  <br>
  <div class="container">
    <form class="form-inline" method="POST" action="includes/process/p-supplier.php">
    <input name="deleteForm" value="true" style="display: none"></input>
      <label for="name">Supplier ID:</label>
      <div class="custom-select" style="width:200px;">
        <select name="sIDs" id="sIDs">
          <option w3-repeat="ids">{{id}}</option>
        </select>
      </div>
      <label for="phone">Supplier Name:</label>
      <input type="name" id="sName" placeholder="Supplier Name..." name="sName">
      <button type="submit">Remove Supplier</button>
    </form>
  </div>
<br>
  <br><br><br>
 
</body>

<?php
$suppliers = new Supplier();
$phpSuppliers = $suppliers->getAllSuppliers();
?>
<script>
  const phpSuppliers = '<?php echo json_encode($phpSuppliers); ?>';
  const suppliersObjArray = Object.values(JSON.parse(phpSuppliers));
  w3.displayObject("supplierDisplay", {"suppliers": suppliersObjArray});
  w3.displayObject("sIDs", {"ids": suppliersObjArray});
</script>

<script src="js-files/dropdown.js"></script>


</html>