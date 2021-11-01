<?php
function constructQuery($connection, $category, $style, $starch, $meat, $searchTerm) {
  $thisQuery = "SELECT name, price FROM items ";
  if ($category != "_") {
    $thisQuery .= "WHERE category LIKE '" . $category . "' ";
  } else {
    $thisQuery .= "WHERE category LIKE '%' ";
  }
  if ($style != "_") {
    $thisQuery .= "AND style LIKE '" . $style . "' ";
  }
  if ($starch != "_") {
    $thisQuery .= "AND starch LIKE '" . $starch . "' ";
  }
  if ($meat != "_") {
    $thisQuery .= "AND meat LIKE '" . $meat . "' ";
  }
  if ($searchTerm != "_") {
    $thisQuery .= "AND name LIKE '%".$searchTerm."%' ";
  } 
  $thisQuery .= "ORDER BY style ";
  $thisResult = mysqli_query($connection, $thisQuery);
  return $thisResult;
}

function printItems($items, $title) {
  if (mysqli_num_rows($items) > 0) {
    if ($title != "_") {
      echo '<h5>' . $title . '</h5>';
    }
    echo '<ul class="leader-list">';
    while($row = mysqli_fetch_array($items)) {
      echo "<li><span>" . $row['name'] . "</span><span>" . $row['price'] . "</span></li>";
    }
    echo '</ul>';
  }
}

$q = $_GET['q'];

$con = mysqli_connect('localhost','uppvncnfso5jg','o2bg6bcva3lm','db0gxub8ri8hb3');
if (!$con) {
die('Could not connect: ' . mysqli_error($con));
}
mysqli_select_db($con,"db0gxub8ri8hb3");

$items = constructQuery($con, "_", "_", "_", "_", $q);
if (mysqli_num_rows($items) < 1) {
  echo "<p>Sorry, we couldn't find that item.</p>";
} else {
  $items = constructQuery($con, "Appetizers", "_", "_", "_", $q);
  if (mysqli_num_rows($items) > 0) {
    echo '<h3>APPETIZERS</h3>';
    printItems($items, "_");
  }
  $items = constructQuery($con, "Entrees", "_", "_", "_", $q);
  if (mysqli_num_rows($items) > 0) {
    echo "<h3>ENTREES</h3><p>All entrees that aren't soups come with a side of clear soup. Rice dishes can be served with either steamed or fried rice.</p>";
    $items = constructQuery($con, "Entrees", "_", "Rice", "_", $q);
    if (mysqli_num_rows($items) > 0) {
      echo "<h4>RICE DISHES</h4>";
      $items = constructQuery($con, "Entrees", "_", "Rice", "Shrimp", $q);
      printItems($items, "Shrimp");
      $items = constructQuery($con, "Entrees", "_", "Rice", "Beef", $q);
      printItems($items, "Beef");
      $items = constructQuery($con, "Entrees", "_", "Rice", "Chicken", $q);
      printItems($items, "Chicken");
      $items = constructQuery($con, "Entrees", "_", "Rice", "Pork", $q);
      printItems($items, "Pork");
      $items = constructQuery($con, "Entrees", "_", "Rice", "Vegetable", $q);
      printItems($items, "Vegetable");
      $items = constructQuery($con, "Entrees", "_", "Rice", "Tofu", $q);
      printItems($items, "Tofu");
      $items = constructQuery($con, "Entrees", "_", "Rice", "Combination", $q);
      printItems($items, "Combination");
    }
    $items = constructQuery($con, "Entrees", "_", "Noodle", "_", $q);
    if (mysqli_num_rows($items) > 0) {
      echo "<h4>NOODLES</h4>";
      $items = constructQuery($con, "Entrees", "Bun", "Noodle", "_", $q);
      printItems($items, "Bun");
      $items = constructQuery($con, "Entrees", "Curry Noodles", "Noodle", "_", $q);
      printItems($items, "Curry Noodles");
      $items = constructQuery($con, "Entrees", "Yaki Udon", "Noodle", "_", $q);
      printItems($items, "Yaki Udon");
      $items = constructQuery($con, "Entrees", "Yaki Soba", "Noodle", "_", $q);
      printItems($items, "Yaki Soba");
      $items = constructQuery($con, "Entrees", "Lo Mein", "Noodle", "_", $q);
      printItems($items, "Lo Mein");
      $items = constructQuery($con, "Entrees", "Pad Thai", "Noodle", "_", $q);
      printItems($items, "Pad Thai");
    }
    $items = constructQuery($con, "Entrees", "_", "Soup", "_", $q);
    if (mysqli_num_rows($items) > 0) {
      echo "<h4>SOUPS</h4>";
      $items = constructQuery($con, "Entrees", "Pho", "Soup", "_", $q);
      printItems($items, "Pho");
      $items = constructQuery($con, "Entrees", "Soba Soup", "Soup", "_", $q);
      printItems($items, "Soba Soup");
      $items = constructQuery($con, "Entrees", "Udon Soup", "Soup", "_", $q);
      printItems($items, "Udon Soup");
    }
  }
}

mysqli_close($con);
?>
