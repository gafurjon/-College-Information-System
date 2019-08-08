<section class="page-content">
    <div class="row">
        <?php

        foreach ($news as $item){

            $name=$item['name'];
            $picture='';
            $news=$item['news'];
            $date=$item['date'];
            $news_type=$item['news_type'];
            $user_news_id=$item['user_id'];


            if ($picture=='')
            {
                echo "<div class='col-md-12'>";
                if($news_type==1){ echo "<div class='alert alert-block alert-info'>";
                    echo "<button type='button' class='close' data-dismiss='alert'>
						<i class='ace-icon fa fa-times'></i></button>
					$news</div>";}


                elseif($news_type==2)
                { echo "<div class='alert alert-block alert-success'>";
                    echo "<button type='button' class='close' data-dismiss='alert'>
						<i class='ace-icon fa fa-times'></i></button>
					$news</div>";};
                echo '</div>';

            }}
        ?>

    </div>
</section>