<!DOCTYPE html>
<html>
<head>
	<title>Preview PDF</title>
</head>
<body>

<div class="content-wrapper">
    <div class="container-fluid">

        <div class="card mb-3">
            <div class="card-body">

                <div class="panel-body">
                    <div>
                            <?= $this->session->flashdata('msg') ?>
                    </div>
                    
                    <object data="<?php echo base_url().$file; ?>" type="application/pdf" width="100%" height="500px" style="margin-top: 3%">
                        <embed src="<?php echo base_url().$file; ?>" type="application/pdf">
                        </embed>
                        <p>This browser does not support PDFs. Please download the PDF to view it: <a href="<?php echo $file; ?>">Download PDF</a>.</p>
                    </object>

                </div>
            </div>      
        </div>
      </div>
    </div>
</div>


</body>
</html>