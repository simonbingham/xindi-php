<?php var_dump($breadcrumbs); ?>

<?php foreach($breadcrumbs as $breadcrumb) { ?>
	<li><?php var_dump($breadcrumb->title); ?></li>
<?php } ?>

<!-- 
$query = $this->db->query("YOUR QUERY");

if ($query->num_rows() > 0)
{
   foreach ($query->result() as $row)
   {
      echo $row->title;
      echo $row->name;
      echo $row->body;
   }
}
-->

<h1><?php echo $title; ?></h1>

<?php echo $content;?>