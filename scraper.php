<?
// This is a template for a PHP scraper on morph.io (https://morph.io)
// including some code snippets below that you should find helpful

// require 'scraperwiki.php';
// require 'scraperwiki/simple_html_dom.php';
//
// // Read in a page
// $html = scraperwiki::scrape("http://foo.com");
//
// // Find something on the page using css selectors
// $dom = new simple_html_dom();
// $dom->load($html);
// print_r($dom->find("table.list"));
//
// // Write out to the sqlite database using scraperwiki library
// scraperwiki::save_sqlite(array('name'), array('name' => 'susan', 'occupation' => 'software developer'));
//
// // An arbitrary query against the database
// scraperwiki::select("* from data where 'name'='peter'")

// You don't have to do things with the ScraperWiki library.
// You can use whatever libraries you want: https://morph.io/documentation/php
// All that matters is that your final data is written to an SQLite database
// called "data.sqlite" in the current working directory which has at least a table
// called "data".




// This is a template for a PHP scraper on morph.io (https://morph.io)
// including some code snippets below that you should find helpful
// require 'scraperwiki.php';
// require 'scraperwiki/simple_html_dom.php';
//
// // Read in a page
// $html = scraperwiki::scrape("http://foo.com");
//
// // Find something on the page using css selectors
// $dom = new simple_html_dom();
// $dom->load($html);
// print_r($dom->find("table.list"));
//
// // Write out to the sqlite database using scraperwiki library
// scraperwiki::save_sqlite(array('name'), array('name' => 'susan', 'occupation' => 'software developer'));
//
// // An arbitrary query against the database
// scraperwiki::select("* from data where 'name'='peter'")
// You don't have to do things with the ScraperWiki library.
// You can use whatever libraries you want: https://morph.io/documentation/php
// All that matters is that your final data is written to an SQLite database
// called "data.sqlite" in the current working directory which has at least a table
// called "data".
$db = new PDO('sqlite:data.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
try {
  $db->query('CREATE TABLE data(
    guid VARCHAR(100),
    description TEXT,
    title VARCHAR(100),
    article_timestamp VARCHAR(10),
    PRIMARY KEY (guid))');
} catch (Exception $e) {
}
$articles = array(array('guid' => "3", 'description' => 'this is a test', 'title' => 'this is a title', 'article_timestamp' => 'date'));
foreach ($articles as $article) {
  $exists = $db->query("SELECT * FROM data WHERE guid = " . $db->quote($article->guid))->fetchObject();
  if (!$exists) {
    $sql = "INSERT INTO data(guid, description, title, article_timestamp) VALUES(:guid, :description, :title, :article_timestamp)";
  } else {
    $sql = "UPDATE data SET description = :description, article_timestamp = :article_timestamp WHERE guid = :guid";
  }
  $statement = $db->prepare($sql);
    $statement->execute(array(
    ':guid' => $article['guid'], 
    ':description' => $article['description'],
    ':title' => $article['title'],
    ':article_timestamp' => $article['article_timestamp']
  ));
}
?>

