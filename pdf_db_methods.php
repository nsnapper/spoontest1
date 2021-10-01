<?php

class PdfPage {
  public $id;
  public $title;
  public $description;
  public $image;
  public $parent_page_id;
  public $sort_index;

  function __construct($id, $title, $description, $image, $parent_page_id, $sort_index) {
    $this->id = $id;
    $this->title = $title;
    $this->description = $description;
    $this->image = $image;
    $this->parent_page_id = $parent_page_id;
    $this->sort_index = $sort_index;
  }
  
  function get_id() {
    return $this->id;
  }
  function get_title() {
    return $this->title;
  }
  function set_title($title) {
    $this->title = $title;
  }

  function get_description() {
    return $this->description;
  }
  function set_description($description) {
    $this->description = $description;
  }

  function get_image() {
    return $this->image;
  }
  function set_image($image) {
    $this->image = $image;
  }

  function get_parent_page_id() {
    return $this->parent_page_id;
  }
  function set_parent_page_id($parent_page_id) {
    $this->parent_page_id = $parent_page_id;
  }

  function get_sort_index() {
    return $this->sort_index;
  }
  function set_sort_index($sort_index) {
    $this->sort_index = $sort_index;
  }
}

/*
 * PDF Page CRUD methods.
 */
function get_all_pdf_pages() {
  global $connection;

  $pdf_pages = array();
  $query = "SELECT * FROM pdf_pages ORDER BY sort_index, title";
  $pdf_page_info = mysqli_query($connection, $query);
  $count = mysqli_num_rows($pdf_page_info);

  $pdf_page_array = array();
  while ($row = mysqli_fetch_assoc($pdf_page_info)) {
    $pdf_page = new PdfPage($row['id'], $row['title'], $row['description'], $row['page_image'], $row['parent_id'], $row['sort_index']);
    array_push($pdf_page_array, $pdf_page);
  }
  return $pdf_page_array;
}

function get_pdf_pages_for_parent($parent_id) {
  global $connection;

  $pdf_pages = array();
  $query = "SELECT * FROM pdf_pages WHERE parent_id=$parent_id ORDER BY sort_index, title";
  $pdf_pages = mysqli_query($connection, $query);
  $count = mysqli_num_rows($pdf_pages);

  $pdf_page_array = array();
  while ($row = mysqli_fetch_assoc($pdf_pages)) {
    $pdf_page = new PdfPage($row['id'], $row['title'], $row['description'], $row['page_image'], $row['parent_id'], $row['sort_index']);
    array_push($pdf_page_array, $pdf_page);
  }
  return $pdf_page_array;
}

function get_pdf_page($page_id) {
  global $connection;

  $query = "SELECT * from pdf_pages where id=$page_id";
  $pdf_page_info = mysqli_query($connection, $query);
  $count = mysqli_num_rows($pdf_page_info);

  $pdf_page = null;
  if ($count > 0) {
    $row = mysqli_fetch_assoc($pdf_page_info);
    $pdf_page = new PdfPage($row['id'], $row['title'], $row['description'], $row['page_image'], $row['parent_id'], $row['sort_index']);
  }
  return $pdf_page;
}

function add_pdf_page($title, $description, $image, $parent_page_id, $sort_index) {
  global $connection;

  $query = "INSERT INTO pdf_pages(title, description, parent_id, page_image)";
  $query .="VALUES('{$title}', '{$description}','{$parent_page_id}','{$image}', '{$sort_index}')";

  error_log("Adding new PDF Type: $title", 0);
  $add_product_query = mysqli_query($connection, $query);
  return $add_product_query;
}

function update_pdf_page($pdf_page) {
  global $connection;

    $query = "UPDATE pdf_pages set title='{$pdf_page->get_title()}', description='{$pdf_page->get_description()}',";
    $query .= " parent_id={$pdf_page->get_parent_page_id()}, page_image='{$pdf_page->get_image()}', sort_index='{$pdf_page->get_sort_index()}'";
    $query .= " WHERE id={$pdf_page->get_id()}";

    error_log("update_pdf_page: QUERY: $query");

    $result = mysqli_query($connection, $query);
    error_log("update_pdf_page: returning...");
    return $result;
}

/*
 * Delete an existing PDF page type.
 *
 * TODO: Make sure there's no foreign key constraints tied to the page being deleted.
 */
function delete_pdf_page($pdf_page_id) {
  global $connection;

  $query = "DELETE from pdf_pages where id={$pdf_page_id}";
  $result = mysqli_query($connection, $query);
  return $result;
}

/*
 * PDF File CRUD methods responsible for uploading, editing, and deleting PDF files.
 */
class PdfFile {
  public $id;
  public $title;
  public $thumbnail_image;
  public $pdf_file;
  public $pdf_page_id;
  public $sort_index;

  function __construct($id, $title, $thumbnail_image, $pdf_file, $pdf_page_id, $sort_index) {
    $this->title = $title; 
    $this->thumbnail_image = $thumbnail_image; 
    $this->pdf_file = $pdf_file; 
    $this->pdf_page_id = $pdf_page_id; 
    $this->id = $id;
    $this->sort_index = $sort_index;
  }
  
  function get_id() {
    return $this->id;
  }
  
  function get_title() {
    return $this->title;
  }
  function set_title($title) {
    $this->title = $title;
  }

  function get_thumbnail_image() {
    return $this->thumbnail_image;
  }
  function set_thumbnail_image($thumbnail_image) {
    $this->thumbnail_image = $thumbnail_image;
  }

  function get_pdf_file() {
    return $this->pdf_file;
  }
  function set_pdf_file($pdf_file) {
    $this->pdf_file = $pdf_file;
  }

  function get_pdf_page_id() {
    return $this->pdf_page_id;
  }
  function set_pdf_page_id($pdf_page_id) {
    $this->pdf_page_id = $pdf_page_id;
  }

  function get_sort_index() {
    return $this->sort_index;
  }
  function set_sort_index($sort_index) {
    $this->sort_index = $sort_index;
  }
}

// PDF CRUD methods
function get_pdf_files_for_page($pdf_page_id) {
  global $connection;
  
  $query = "SELECT * FROM pdf_links WHERE pdf_page_id=$pdf_page_id ORDER BY sort_index";

  $pdf_file_array = array();
  $pdf_files = mysqli_query($connection, $query);
  $count = mysqli_num_rows($pdf_files);

  if ($count > 0) {
    while($row = mysqli_fetch_assoc($pdf_files)){
      $pdf_file = new PdfFile($row['id'], $row['title'], $row['pdf_image'], $row['pdf_filename'], $row['pdf_page_id'], $row['sort_index']);

      array_push($pdf_file_array, $pdf_file);
    }
  }
  return $pdf_file_array;
}

function get_pdf_file($pdf_file_id) {
  global $connection;

  $query = "SELECT * from pdf_links where id=$pdf_file_id";
  $pdf_file_info = mysqli_query($connection, $query);
  $count = mysqli_num_rows($pdf_file_info);

  $pdf_page = null;
  if ($count > 0) {
    $row = mysqli_fetch_assoc($pdf_file_info);
    $pdf_file = new PdfFile($row['id'], $row['title'], $row['pdf_image'], $row['pdf_filename'], $row['pdf_page_id'], $row['sort_index']);
  }
  return $pdf_file;

}

function add_pdf_file($title, $thumbnail_image, $pdf_filename, $pdf_page_id, $sort_index) {
  global $connection;

  $query = "INSERT INTO pdf_links(title, pdf_filename, pdf_image, pdf_page_id, sort_index)";
      
  $query .="VALUES('{$title}', '{$pdf_filename}','{$thumbnail_image}','{$pdf_page_id}', '{$sort_index}')";

  error_log("Adding new PDF File: QUERY: $query", 0);
  $result = mysqli_query($connection, $query);
  error_log("add_pdf_file: returning...");
  return $result;
}

function update_pdf_file($pdf_file) {
  global $connection;

    $query = "UPDATE pdf_links set title='{$pdf_file->get_title()}', pdf_filename='{$pdf_file->get_pdf_file()}',";
    $query .= " pdf_page_id={$pdf_file->get_pdf_page_id()}, pdf_image='{$pdf_file->get_thumbnail_image()}',";
    $query .= " sort_index='{$pdf_file->get_sort_index()}'";
    $query .= " WHERE id={$pdf_file->get_id()}";

    error_log("update_pdf_file: QUERY: $query");

    $result = mysqli_query($connection, $query);
    error_log("update_pdf_page: returning...");
    return $result;
}

function delete_pdf_file($pdf_file_id) {
  global $connection;

  $query = "DELETE from pdf_links where id={$pdf_file_id}";
  $result = mysqli_query($connection, $query);
  return $result;
}
?>
