<?php
/**
 * Created by PhpStorm.
 * User: cengkuru
 * Date: 2/3/2015
 * Time: 6:45 PM
 */
?>

<div class="card">

    <div class="card-body text-default-light">
        <?php
        if(check_my_access('add_file_categories'))
        {
        ?>
            <a class="btn ink-reaction btn-floating-action btn-primary"
                                       href="<?=base_url().$this->uri->segment(1).'/'.$this->uri->segment(2).'/add'?>"><i class="md md-add"></i></a>

        <?php
        }

        ?>

        <div class="panel-body">

            <!--                code here-->
            <table class="table datatable">
                <thead>
                <tr>
                    <th>Title</th>
                </tr>
                </thead>
                <tbody>
                <?php
                //print_array($all_houses_paginated);
                foreach($file_categories as $row)
                {

                ?>
                <tr>

                    <td class="hidden-xs">
                        <?php
                        //if category is not locked
                        if ($row['lock'] != 'y') {
                        //if user has permission
                        if (check_my_access('edit_file_categories')) {
                        ?>
                        <a href="<?= base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/edit/' . $row['slug'] ?>"><i
                                class="fa fa-edit"></i></a>
                        <?php
                        }

                        ?>

                                               <?php
                        //if user has permission
                        if (check_my_access('delete_file_categories')) {
                        ?>
                        <a class="action_btn" href="" data-id="<?= $row['id'] ?>"
                           data-action="delete_file_category"
                           data-title="Delete  <?= ucwords($row['title']) ?>"
                           data-toggle="modal" data-target="#myModal"><i
                                class="fa fa-trash-o text-danger"></i></a>
                        <?php
                        }

                        }


                        ?>


                        <a  href="<?=base_url().$this->uri->segment(1).'/admin_files/by_category/'.encryptValue($row['id'])?>">
                            <?=ucwords($row['title'])?>
                            <div class="pull-right">
                                <?php
                                //if there is a tag
                                if($row['tags']){
                                foreach(pipes_to_array($row['tags']) as $tag){
                                ?>
                                <span class="label label-default"><?=get_tag_info($tag,'title')?></span>
                                <?php
                                }
                                }

                                ?>
                            </div>


                        </a>
                        <br>
                        <small>
                            <?=ucwords(time_ago($row['dateadded']))?> | <?=ucwords(get_user_info_by_id($row['author'],'fullname'))?>
                        </small>
                    </td>

                </tr>
                <?php

                }
                ?>

                </tbody>
            </table>
    </div><!--end .card-body -->
</div>













<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>

    //when ann action butoon is clicked
    $('.action_btn').click(function(){
        //get model content
        var modal_title=$(this).data('title');
        var action=$(this).data('action');
        //alert($(this).data('id'));


        //replace the model title
        $("#myModalLabel").html(modal_title);

        //replace modal content
        $(".modal-body").html('<img src="<?=base_url()?>images/loading.gif" />');

        //switch depending on action
        switch (action)
        {

            case 'delete_file_category':
                var category_data=
                {
                    ajax:action,
                    id:$(this).data('id')
                };
                $.ajax({
                    url: "<?php echo site_url($this->uri->segment(1).'/'.$this->uri->segment(2).'/ajax_calls') ?>",
                    type: 'POST',
                    data: category_data,
                    success: function(msg)
                    {

                        $('.modal-body').html(msg);

                    }
                });
                break;

        }
    });
</script>

