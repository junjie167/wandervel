<!DOCTYPE html>
<html lang="en">

    <meta charset="utf-8"/>
    <title>Create Tips</title>
    <?php include "head.php";
    ?>
    <!--<head>
            <link rel="stylesheet" href="css/tips.css">
            <script defer src="js/tips.js"></script>


        </head>-->


        <body class="tipsBody">
        <header>
            <?php include "navbar.php"; ?>
        </header>

        <main>

            <section>
                <div class="container"> 
                   
                    <h1 id="headerTips">Create Tips</h1>
                    <form id="tipsform" name="tipsform" action="createtipsProcess.php" method="POST">
                        <div class="form-group">
                            <label style="font-size: 20px;" for="tipsTopic">Topic:</label>                       
                            <input class="form-control" type="text" id="tipsTopic" name="tipsTopic" placeholder="Enter Topic" required/>
                        </div>
                        <div class="form-group">
                            <label style="font-size: 20px;" for="tipsCat">Category:</label>
                            <input class="form-control" id="tipsCat" type="text" name="tipsCat" placeholder="Enter Category" required/>
                        </div>
                        <div class="form-group">
                            <label style="font-size: 20px;" for="tipsCountry">Country(Optional):</label>
                            <input class="form-control" id="tipsCountry" type="text" name="tipsCountry" placeholder="Enter Country (optional)"/>
                           
                        </div>
                        <div class="form-group">
                        <label for="tipsContent"><a>Tips Content:</a></label>
                        <textarea class="form-control" rows="10" name="tipsContent" type="text" id="tipsContent" ></textarea>
                        </div>
                        



                        <div class="form-group">  
                            <button class="btn btn-primary" type="submit">Create Tip</button>
                        </div>
                    </form>
                </div> 
            </section>
        </main>

     <?php
    include 'footer.php';
    ?>
    </body>
</html>
