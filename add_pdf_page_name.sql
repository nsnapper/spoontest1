ALTER TABLE pdf_pages ADD COLUMN page_name varchar(256);

ALTER TABLE pdf_pages ADD CONSTRAINT UC_pdf_pages UNIQUE (page_name);
