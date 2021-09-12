<?php require_once './includes/header.php'; ?>
<div class="fluid-container">
  <?php require_once './includes/menu.php'; ?>
  <?php 
     $post_per_page = 1;
     $sql  = "select * from posts";
     $stmt = $con->prepare($sql);
     $stmt->execute();
     $post_count    = $stmt->rowCount();     
     $total_pages   = ceil($post_count / $post_per_page);     
     if(isset($_GET['page'])){
       $page = $_GET['page'];
         if($page == 1){
            $page_id = 0;
         }else{
            $page_id = ($post_per_page * $page) - $post_per_page;
         }
     }else{
            $page_id = 0;
            $page    = 1;
      }
  ?>
  <section id="main" class="mx-5">
    <h2 class="my-3">All Posts</h2>
    <?php
       $sql  = "select * from posts LIMIT $page_id, $post_per_page";
       $stmt = $con->prepare($sql);
       $stmt->execute();
       while($row     = $stmt->fetch(PDO::FETCH_ASSOC)){
       $post_id       = $row['post_id'];
       $post_title    = $row['post_title'];
       $post_desc     = substr($row['post_description'], 0,250);
       $post_image    = $row['post_image'];
       $post_date     = $row['post_date'];
       $post_category = $row['post_category_id'];
       $post_status   = $row['post_status'];
       $post_author   = $row['post_author']; ?>    
    <div class="row my-4 single-post">
      <img class="col col-lg-4 col-md-12" src="./img/<?= $post_image; ?>" alt="Image">
      <div class="media-body col col-lg-8 col-md-12">
        <h5 class="mt-0"><a href="single.php?id=<?= $post_id; ?>"><?= $post_title; ?></a></h5>
        <span class="posted">
              <?php
                 $sql1  = "select * from categories where category_id =:id";
                 $stmt1 = $con->prepare($sql1);
                 $stmt1->execute([
                    ':id'=>$post_category
                 ]);
                 while($row = $stmt1->fetch(PDO::FETCH_ASSOC)){
                    $category_id   = $row['category_id'];
                    $category_name = $row['category_name'];
                 }
              ?>
          <a href="category.php?id=<?= $category_id; ?>" class="category"><?= $category_name; ?> </a> <?= 'Posted by '.$post_author.' on '.$post_date; ?></span>
        <p><?= $post_desc; ?></p>
        <span><a href="single.php?id=<?= $post_id; ?>" class="d-block">See more &rarr;</a></span>
      </div>
    </div>    
    <?php } ?>    
  </section>  
  <?php 
      if($post_count > $post_per_page){ ?>
          <ul class="pagination px-5">            
            <?php 
               if($page_id == 0){
                    echo '<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Previous</a></li>';
               }else{
                    echo '<li class="page-item"><a class="page-link" href="index.php?page='.$page_id.'" tabindex="-1">Previous</a></li>';
               }
            ?>
            
            <?php 
               for($i=1; $i <= $total_pages; $i++){
                  if($i == $page_id + 1){
                      echo '<li class="page-item active"><a class="page-link" href="index.php?page='.$i.'">'.$i.'</a></li>';  
                  }else{
                      echo '<li class="page-item"><a class="page-link" href="index.php?page='.$i.'">'.$i.'</a></li>';  
                  }
                  
                }
            ?>
            <?php 
                $next = $page_id + 2;
                if($page_id + 1 == $total_pages){
                    echo '<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>';
                }else{
                    echo '<li class="page-item"><a class="page-link" href="index.php?page='. $next.'">Next</a></li>';
                }
            ?>            
          </ul>
   <?php  }
  ?>
<?php require_once './includes/footer.php'; ?>
      