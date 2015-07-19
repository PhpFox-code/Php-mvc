<h1 class="h1_books">Main page Books View</h1>


<div class="books_action">
	<div class="books_button">
	    <form action="books/addform" class="button_link">
          <button type="submit">Add Book</button>
        </form>
	</div>
	<div class="books_button">
	    <form action=" http://example/books/deleteAll" class="button_link">
          <button type="submit">Delete All Books</button>
        </form>		
	</div>
</div>

<?php if(isset($books) or !empty($books)): ?>
  <table class="books_table">
   <tr><th class="books_table_row head">Name</th>
       <th class="books_table_row head">Description</th>
       <th class="books_table_row head">Date</th>
       <th class="books_table_row head">Autor</th>
       <th class="books_table_row head">Pages</th>
       <th class="books_table_row head">actions</th>
   </tr>

     <?php foreach ($books as $value) { ?>

      <tr> <th style="display:none"><?=$value["id"];?></th>  
        <th class="books_table_row"><?=$value["Name"];?></th>
        <th class="books_table_row"><?=$value["Description"];?></th>
        <th class="books_table_row"><?=$value["Date"];?></th>
        <th class="books_table_row"><?=$value["Autor"];?></th>
        <th class="books_table_row"><?=$value["Pages"];?></th>
        <th class="books_table_row"><a href="http://example/books/edit_get?id=<?=$value["id"];?>" >Edit</a> 
        <a href="http://example/books/delete?id=<?=$value["id"];?>">Delete</a> </th>
      </tr>

   <?php } ?> 
  </table>	
<?php else: ?>
	<h2>Book list is empty !</h2>
<?php endif; ?> 




