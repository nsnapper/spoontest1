## Administrative Layout / Functions / Features
The Catalog feature of the web site consists of a set of dynamically
created catalogs.  The catalogs all consist of a root page that can contain
both PDF files and sub-pages like Licenses and Catalog Sections for example.  Each sub-page can contain both PDF files as well as other sub
pages if this level of granularity is needed.  Here's an example layout
tree displayed at the root page *ob_admin.php*

- Canadian Catalogs
- - Spoontiques January 2021 Catalog with Canadian Pricing
- - New for Summer 2021 with Canadian Pricing
- - Individual Sections with Canadian Pricing
- - Individual Licenses with Canadian Pricing
- US Catalogs
- - Spoontiques January 2021 Catalog (link to pdf file)
- - New For Summer 2021 (link to pdf file)
- - Individual Sections (Links to catalog section pdf files)
- - Individual Licenses (Links to individual pdf license pdf files)

### PHP Pages
**NOTE:** Each admin page contains the common admin_header that presents links for navigating the admin functions

ob_admin.db - The root page for site admin.  This will display links to 
all the top level catalogs that have been defined.

ob_categories.php - Lists all the website defined categories used for displaying 
pages.  Each category can hold many products

ob_add_category.php - Defines a new product category.

ob_edit_category.php - Allows editing a previously defined product category.

ob_products.php - Lists all defined products in the system DB.  Each product is 
linked to a specific product category.

ob_add_product.php - Add a new product definition.

ob_edit_category.php - Edit a defined product.

ob_pdf_pages.php - Lists all PDF Page definitions.  Each page contains a parent
page identifier.  The special parent page id of 0 represents a root PDF page.
This is used to define top level catalog pages like US and Canadian catalog pages.

ob_add_pdf_page.php - Adds a PDF page to the system.  This includes a thumbnail image
associated with the page link as well as a link to the children PDF files and PDF catalog
pages.

ob_update_pdf_page.php - Provides edit capabilities for PDF pages.

ob_pdf_files.php - This page lists all PDF files associated with the specified PDF
catalog page.

ob_add_pdf_file.php - Adds a PDF file to the system.  This includes a thumbnail image
as well as the PDF file.  Both are uploaded to the system and available to be accessed.

ob_update_pdf_file.php - This provides edit / update capability for PDF files.

### PHP Support Files

app_variables.php - Contains variables used throughout the app.  The root variable, $app_root_dir, is set to the root web path relative to the 
spoontiques.com domain.  This makes it easier for testing on a dev server
where the root could be different.

pdf_db_methods.php - This contains methods for manipulating the PDF page
and file tables.  All of these methods return objects defined in the file
that describe the contents of a single row in a table.  If a single page or
file is requested a single instance of PdfPage or PdfFile object.  If a
request for a list of pages or files is requested an array of PdfPage or 
PdfFile objects will be returned.

### PDF SQL Table Creation.
create_pdf_tables.sql - this will drop and create pdf_pages and pdf_links
tables.
