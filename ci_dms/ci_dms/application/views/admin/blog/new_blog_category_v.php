<?php
/*
#Author: Cengkuru Micheal
9/12/14
2:47 PM
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>


<div class="card">

    <div class="card-body text-default-light">
        <p>
            <a class="btn ink-reaction btn-floating-action btn-primary"
                                       href="<?=base_url().$this->uri->segment(1).'/'.$this->uri->segment(2)?>/blog_categories"><i class="md md-list"></i></a>
        </p>
        <?=$this->load->view('admin/blog/forms/add_blog_category_f')?>
    </div><!--end .card-body -->
</div>
