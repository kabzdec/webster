<form method="POST">
	<div class="form-group">
    <label for="user">Имя пользователя</label>
    <input type="user" class="form-control" id="user" name="user" required>
    
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" required>

  <label for="comment">Текст задачи</label>
  <textarea class="form-control" rows="5" id="comment" name="some_text" required></textarea>
<?=$message?>
  <button type="submit" class="btn btn-primary">Добавить</button>
  </div> 
</form> 
<div class='tasks'><?php
if (isset($_GET['page']) || isset($_GET['sort'])){
$page = $_GET['page'];
$task = new Task($user,$email,$some_text,$page,$_GET['sort']);
$task->showComments();
} 
 else 
{
$task = new Task();
$task->showComments();  
}
?>
 <ul class="pagination">
  <?=$task->numPages();?>
</ul> 
</div>