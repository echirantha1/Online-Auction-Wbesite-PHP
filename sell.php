<?php session_start() ?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <title>Sell</title>

    <link rel="stylesheet" href="style/styles.css">
</head>
<?php include 'admin/db_connect.php' ?>
<?php
if(isset($_GET['id'])){
$qry = $conn->query("SELECT * FROM products where id= ".$_GET['id']);
foreach($qry->fetch_array() as $k => $val){
	$$k=$val;
        }
    }
?>
<?php include('header.php') ?>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="./index.html">
                <img src="assets/img/Logo.png" alt="" width="150" height="70">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin-left: auto;">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./contact.html">Contact</a>
                    </li>
					<li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="admin/ajax.php?action=logout2">Logout <i class="fa fa-power-off"></i></a>
					</li>
                </ul>

            </div>
        </div>
    </nav>

    <div class="contactform">
        <h2 id="formheading" style="font-weight: bold;">Auction Your Vehicle</h2><br>
        <div class="container d-flex" style="justify-content: center;">
            <form method="post" action="sell.php" enctype="multipart/form-data">
				<div class="form-group">
                    
                    <div class="col-md-8">
                        <label for="" class="control-label">Name</label>
                        <input type="text" class="form-control" name="name" value="<?php echo isset($name) ? $name :'' ?>" required>
                    </div><br>

                    <div class="col-md-8">
                        <label for="" class="control-label">Category</label>
                        <select class="custom-select select2" name="category_id">
                            <option value=""></option>
                            <?php
                            $qry = $conn->query("SELECT * FROM categories order by name asc");
                            while($row=$qry->fetch_assoc()):
                            ?>
                            <option value="<?php echo $row['id'] ?>" <?php echo isset($category_id) && $category_id == $row['id'] ? 'selected' : '' ?>><?php echo $row['name'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div><br>


                    <div class="col-md-15">
                        <label for="" class="control-label">Description</label>
                        <textarea name="description" type="text" id="description" class="form-control" cols="30" rows="5" required><?php echo isset($description) ? html_entity_decode($description) : '' ?></textarea>
                    </div><br>


                    <div class="col-md-8">
                        <label for="" class="control-label">Regular Price</label>
                        <input type="number" class="form-control text-right" name="regular_price" value="<?php echo isset($regular_price) ? $regular_price : 0 ?>">
                    </div>
                    <div class="col-md-8">
                        <label>Starting Bidding Amount</label>
                        <input type="number" class="form-control text-right" name="start_bid" value="<?php echo isset($start_bid) ? $start_bid : 0 ?>">
                    </div><br>


                    <div class="col-md-8">
                        <label for="" class="control-label">Bidding End Date/Time</label>
                        <input type="text" class="form-control datetimepicker" name="bid_end_datetime" placeholder="yyyy/mm/dd 00:00" value="<?php echo isset($bid_end_datetime) && strtotime($bid_end_datetime) > 0 ? date("Y-m-d H:i",strtotime($bid_end_datetime)) : '' ?>">
                    </div><br>


					<div class="col-md-8">
							<label for="" class="control-label">Username</label>
							<input type="text" class="form-control" name="username"  value="<?php echo isset($username) ? $username :'' ?>" required>
					</div>
    

                    <div class="col-md-10">
                        <label for="" class="control-label">Product Image</label>
                        <input type="file" class="form-control" name="img" onchange="displayImg2(this,$(this))">
                    </div><br>

                    <div class="col-md-8">
                        <img src="<?php echo isset($img_fname) ? 'admin/assets/uploads/'.$img_fname :'' ?>" alt="" id="img_path-field">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-sm btn-block btn-primary col-sm-4"> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="imgF" style="display: none " id="img-clone">
			<span class="rem badge badge-primary" onclick="rem_func($(this))"><i class="fa fa-times"></i></span>
	</div>

    <footer class="sticky">

        <div class="container py-5">
                <div class="row">
                    <div class="col-lg-2 mb-3">
                        <a class="d-inline-flex align-items-center mb-2 link-dark text-decoration-none" href="./index.html"
                            aria-label="Bootstrap">
                            <img src="assets/img/Logo.png" alt="" width="250" height="120">

                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z"
                                fill="currentColor"></path>
                            </svg>
                        </a>

                    </div>
                    <div class="col-6 col-lg-2 offset-lg-2 mb-3">
                        <h5>About Us</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="">About BidMe.LK</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-lg-2 mb-3">
                        <h5>We're here to help</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="./contact.html">Contact Us</a></li>
                            <a class="d-block" href="mailto:<?php echo $_SESSION['system']['email'] ?>"><?php echo $_SESSION['system']['email'] ?></a>
                        </ul>
                    </div>
                    <div class="col-6 col-md">
                        <h5>Follow Us</h5>
                        <ul class="list-unstyled text-small">

                            <a style="font-size: 30px;padding: 10px;" href=""><i class="fab fa-facebook-square"></i></a>
                            <a style="font-size: 30px;padding: 10px;" href=""><i class="fab fa-linkedin"></i></a>
                            <a style="font-size: 30px;padding: 10px;" href=""><i class="fab fa-twitter-square"></i></a>
                            <a style="font-size: 30px;padding: 10px;" href=""><i class="fab fa-instagram"></i></a>

                        </ul>
                    </div>
                </div>

    </footer>

    <button onclick="topFunction()" id="myBtn" title="Go to top">^</button>

    <script>

        $('#payment_status').on('change keypress keyup',function(){
            if($(this).prop('checked') == true){
                $('#amount').closest('.form-group').hide()
            }else{
                $('#amount').closest('.form-group').show()
            }
        })
        $('.jqte').jqte();

        $('#manage-product').submit(function(e){
            e.preventDefault()
            start_load()
            $('#msg').html('')
            $.ajax({
                url:'admin/ajax.php?action=save_product',
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                success:function(resp){
                    if(resp==1){
                        alert_toast("Data successfully saved",'success')
                        setTimeout(function(){
                            location.href = "./index.php"
                        },1500)

                    }
                    
                }
            })
        })
        if (window.FileReader) {
    var drop;
    addproductHandler(window, 'load', function() {
        var status = document.getElementById('status');
        drop = document.getElementById('drop');
        var dname = document.getElementById('dname');
        var list = document.getElementById('list');

        function cancel(e) {
        if (e.preventDefault) {
            e.preventDefault();
        }
        return false;
        }

        // Tells the browser that we *can* drop on this target
        addproductHandler(drop, 'dragover', cancel);
        addproductHandler(drop, 'dragenter', cancel);

        addproductHandler(drop, 'drop', function(e) {
        e = e || window.product; // get window.product if e argument missing (in IE)   
        if (e.preventDefault) {
            e.preventDefault();
        } // stops the browser from redirecting off to the image.
        $('#dname').remove();
        var dt = e.dataTransfer;
        var files = dt.files;
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            //attach product handlers here...

            reader.readAsDataURL(file);
            addproductHandler(reader, 'loadend', function(e, file) {
            var bin = this.result;
            var imgF = document.getElementById('img-clone');
                imgF = imgF.cloneNode(true);
            imgF.removeAttribute('id')
            imgF.removeAttribute('style')

            var img = document.createElement("img");
            var fileinput = document.createElement("input");
            var fileinputName = document.createElement("input");
            fileinput.setAttribute('type','hidden')
            fileinputName.setAttribute('type','hidden')
            fileinput.setAttribute('name','img[]')
            fileinputName.setAttribute('name','imgName[]')
            fileinput.value = bin
            fileinputName.value = file.name
            img.classList.add("imgDropped")
            img.file = file;
            img.src = bin;
            imgF.appendChild(fileinput);
            imgF.appendChild(fileinputName);
            imgF.appendChild(img);
            drop.appendChild(imgF)
            }.bindToproductHandler(file));
        }
        return false;

        });

        Function.prototype.bindToproductHandler = function bindToproductHandler() {
        var handler = this;
        var boundParameters = Array.prototype.slice.call(arguments);
        return function(e) {
            e = e || window.product; // get window.product if e argument missing (in IE)   
            boundParameters.unshift(e);
            handler.apply(this, boundParameters);
        }
        };
    });
    } else {
    document.getElementById('status').innerHTML = 'Your browser does not support the HTML5 FileReader.';
    }

    function addproductHandler(obj, evt, handler) {
    if (obj.addproductListener) {
        // W3C method
        obj.addproductListener(evt, handler, false);
    } else if (obj.attachproduct) {
        // IE method.
        obj.attachproduct('on' + evt, handler);
    } else {
        // Old school method.
        obj['on' + evt] = handler;
    }
    }
    function displayIMG(input){

            if (input.files) {
        if($('#dname').length > 0)
            $('#dname').remove();

                    Object.keys(input.files).map(function(k){
                        var reader = new FileReader();
                            reader.onload = function (e) {
                                // $('#cimg').attr('src', e.target.result);
                            var bin = e.target.result;
                            var fname = input.files[k].name;
                            var imgF = document.getElementById('img-clone');
                                imgF = imgF.cloneNode(true);
                            imgF.removeAttribute('id')
                            imgF.removeAttribute('style')
                                var img = document.createElement("img");
                                var fileinput = document.createElement("input");
                                var fileinputName = document.createElement("input");
                                fileinput.setAttribute('type','hidden')
                                fileinputName.setAttribute('type','hidden')
                                fileinput.setAttribute('name','img[]')
                                fileinputName.setAttribute('name','imgName[]')
                                fileinput.value = bin
                                fileinputName.value = fname
                                img.classList.add("imgDropped")
                                img.src = bin;
                                imgF.appendChild(fileinput);
                                imgF.appendChild(fileinputName);
                                imgF.appendChild(img);
                                drop.appendChild(imgF)
                            }
                    reader.readAsDataURL(input.files[k]);
                    })
                    
        rem_func()

            }
            }
        function displayImg2(input,_this) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#img_path-field').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        function rem_func(_this){
                _this.closest('.imgF').remove()
                if($('#drop .imgF').length <= 0){
                    $('#drop').append('<span id="dname" class="text-center">Drop Files Here</label></span>')
                }
        }
    </script>

</body>