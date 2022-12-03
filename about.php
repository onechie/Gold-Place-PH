<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    define('ACCESS', TRUE);
    include './user_include/restrict-admin.php';
    include './user_include/restrict-driver.php';
    include './user_include/links.php';
    $_SESSION['menu'] = 'about';
    ?>

    <link rel="stylesheet" href="./assets/styles/default.css">
    <title>Gold Place PH - About</title>
</head>

<body>
    <?php
    if (isset($_SESSION["userId"])) {
        include './user_include/header-user.php';
    } else {
        include './user_include/header.php';
    }
    ?>
    <main class="mt-5 bg-light h-100 overflow-auto">
        <div class="container-xxl">
            <h2 class="pt-4 pt-sm-5 text-center text-sm-start">About us</h2>
            <div class='my-4 text-center text-sm-start'>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Sit amet nulla facilisi
                morbi. Ultricies leo integer malesuada nunc vel. Mattis aliquam faucibus purus
                in massa. Viverra accumsan in nisl nisi scelerisque. Est ante in nibh mauris
                cursus mattis molestie a iaculis. Leo integer malesuada nunc vel risus commodo
                viverra maecenas. Vitae et leo duis ut diam quam. Sit amet consectetur adipiscing
                elit pellentesque. Tristique et egestas quis ipsum suspendisse ultrices gravida.
                Egestas erat imperdiet sed euismod. Lectus nulla at volutpat diam ut venenatis tellus.
                Nibh mauris cursus mattis molestie a iaculis at erat pellentesque. Consequat interdum
                varius sit amet mattis vulputate enim. Tortor id aliquet lectus proin nibh nisl. Et
                molestie ac feugiat sed lectus vestibulum mattis. Dictum at tempor commodo ullamcorper
                a lacus vestibulum sed arcu. Mauris sit amet massa vitae tortor condimentum. Integer
                vitae justo eget magna fermentum iaculis eu. Lorem sed risus ultricies tristique nulla.
                <br><br>
                Id interdum velit laoreet id donec ultrices tincidunt. Ullamcorper sit amet risus nullam.
                Est lorem ipsum dolor sit amet consectetur adipiscing elit pellentesque. Diam quis enim
                lobortis scelerisque fermentum dui faucibus in. Enim eu turpis egestas pretium. Sed arcu
                non odio euismod lacinia at quis risus. Sit amet justo donec enim. Lacus suspendisse faucibus
                interdum posuere lorem ipsum dolor sit. Semper feugiat nibh sed pulvinar. Etiam non quam lacus
                suspendisse faucibus interdum posuere lorem. Turpis egestas maecenas pharetra convallis posuere.
                A erat nam at lectus urna. Lorem mollis aliquam ut porttitor leo a diam sollicitudin. Ornare arcu
                dui vivamus arcu felis bibendum ut tristique. Vestibulum lectus mauris ultrices eros. Cras pulvinar
                mattis nunc sed blandit libero volutpat sed. Facilisis magna etiam tempor orci eu lobortis
                elementum nibh tellus. Tincidunt eget nullam non nisi est sit amet.
                <br><br>
                Tristique sollicitudin
                nibh sit amet commodo. A iaculis at erat pellentesque adipiscing. Elementum tempus egestas
                sed sed risus. Hac habitasse platea dictumst quisque sagittis purus sit amet. Eros in cursus
                turpis massa tincidunt dui ut ornare lectus. Consectetur a erat nam at lectus urna. Cursus metus
                aliquam eleifend mi in nulla posuere. Ultricies tristique nulla aliquet enim. Luctus accumsan tortor
                posuere ac ut consequat semper viverra nam. Commodo ullamcorper a lacus vestibulum sed arcu non. At
                elementum eu facilisis sed odio. Sed elementum tempus egestas sed sed risus pretium quam vulputate.
                Vulputate eu scelerisque felis imperdiet proin fermentum leo. Tellus mauris a diam maecenas sed enim ut.
            </div>

            <div class="accordion my-4" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne">
                            <h6 class='fw-normal'>Terms of Service</h6>
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <strong>Heading</strong> <br>{content}
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo">
                            <h6 class='fw-normal'>Privacy Policy</h6>
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <strong>Heading</strong> <br>{content}
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree">
                            <h6 class='fw-normal'>Help</h6>
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <strong>Heading</strong> <br>{content}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include './user_include/csrf_token.php';
        include './user_include/footer.php';
        include './user_include/toast.php'; 
        ?>
    </main>

</body>

</html>