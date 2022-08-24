<?php  require_once('../private/initialize.php');
include(SHARED_PATH . '/pos-header.php'); 

?>
<style>
.keypad {
    display: flex;
    font-family: Helvetica;
    font-weight: 400;
    flex-wrap: wrap;
    justify-content: flex-start;
    margin: 0 auto;
    width: 150px;
}

.key {
    color: #000;
    cursor: pointer;
    display: inline-block;
    font-size: 1rem;
    width: 48px;
    height: 48px;
    line-height: 44px;
    border: 1px solid #dfdfdf;
    margin: 1px;
    text-align: center;
    -webkit-transition: all 0.3s;
    transition: all 0.3s;
}

.keypad .key:hover {

    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
    -webkit-box-shadow: 0 0 0 3px rgba(228, 228, 228, 0.45);
    box-shadow: 0 0 0 3px rgba(228, 228, 228, 0.45);
    -webkit-transform: scale(1.2);
    transform: scale(1.2);
    z-index: 2;
}
</style>

<body>
    <div class="content-wrapper">
        <div class="container-fluid  ">

            <div class="row d-flex justify-content-center" style="height: 100vh;">

                <div class="col-12">
                    <div class="dropdown user user-menu">
                        <div class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">

                            <input type="text" id="keypad" size="100" placeholder="Enter Qty" value="1">
                        </div>
                        <div class="dropdown-menu">
                            <div class="keypad">
                                <div class="key" data-id="1">1</div>
                                <div class="key" data-id="1">2</div>
                                <div class="key" data-id="1">3</div>
                                <div class="key" data-id="1">4</div>
                                <div class="key" data-id="1">5</div>
                                <div class="key" data-id="1">6</div>
                                <div class="key" data-id="1">7</div>
                                <div class="key" data-id="1">8</div>
                                <div class="key" data-id="1">9</div>
                                <div class="key" data-id="clear">clear</div>
                                <div class="key" data-id="1">0</div>
                                <!-- <div class="key" data-id="1">&rarr;</div> -->
                                <div class="key" data-id="backspace">&larr;</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</body>
<?php include(SHARED_PATH . '/footer.php'); ?>

<script>
$('#keypad').click(function() {
    $(this).select();
});

$(".key").click(function() {
    let newValue = $(this).text();
    var inputField = $('#keypad');
    let dataId = $(this).data('id')
    if (dataId == 1) {
        inputField.val(inputField.val() + newValue);
    } else if (dataId == 'clear') {
        inputField.val('');
        inputField.focus();
    } else {
        inputField.val(inputField.val().substring(0, inputField.val().length - 1));

    }

});

$(document).on('click', '.dropdown .dropdown-menu', function(e) {
    e.stopPropagation();
});
</script>

</html>