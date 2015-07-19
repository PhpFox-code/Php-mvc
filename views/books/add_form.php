<h2>Form adds book!</h2>


<?php if(isset($books) or !empty($books)): ?>
<?php $book = $books[0]; ?>
<div class="books_form">
  <form action="/books/edit_post" method="POST" name="send_meil" id="send_form">
        <input type="text" name="Id" style="display:none" value="<?=$book["id"];?>">
        <div class="books_input">
           <label for="input_email">Name</label>
           <input type="text" name="Name" value="<?=$book["Name"];?>" placeholder="Name Book">
        </div> 
        <div class="books_input">
           <label for="input_email">Description</label>
           <input type="text" name="Description" placeholder="Description" value="<?=$book["Description"];?>">
        </div>
        <div class="books_input">
            <label for="input_email">Date</label>
        	<input type="date" name="Date" value="<?=$book["Date"];?>" >
        </div>
         <div class="books_input">
            <label for="input_email">Autor</label>
         	<input type="text" name="Autor" value="<?=$book["Autor"];?>" placeholder="Autor name ">
         </div>
         <div class="books_input">
            <label for="input_email">Pages</label>
         	<input type="text" name="Pages" placeholder="Pages"  value="<?=$book["Pages"];?>" >
         </div>
         <div class="books_input">
            <button>Save</button>
             <a href="http://example/books">List books</a>         	
         </div>      
 </form>
</div>

<?php ?> 
<?php else: ?>
<div class="books_form">
  <form action="/books/add" method="POST" name="send_meil" id="send_form">

        <div class="books_input">
           <label for="input_email">Name</label>
           <input type="text" name="Name" value="" placeholder="Name Book">
        </div> 
        <div class="books_input">
           <label for="input_email">Description</label>
           <input type="text" name="Description" placeholder="Description">
        </div>
        <div class="books_input">
            <label for="input_email">Date</label>
        	<input type="date" name="Date" >
        </div>
         <div class="books_input">
            <label for="input_email">Autor</label>
         	<input type="text" name="Autor" placeholder="Autor name">
         </div>
         <div class="books_input">
            <label for="input_email">Pages</label>
         	<input type="text" name="Pages" placeholder="Pages">
         </div>
         <div class="books_input">
            <button>Save</button>
             <a href="http://example/books">List books</a>         	
         </div>      
 </form>
</div>
<?php endif; ?> 

