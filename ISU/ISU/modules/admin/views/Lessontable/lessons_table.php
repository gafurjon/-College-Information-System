<!-- Кисми асоси контент-->



        <div class='col-xs-12 label label-lg label-info arrowed-in arrowed-right'>
            <?php foreach($groups as $group){?>

            <b>Ҷадвали равнди таълимии гурӯҳи- <?php echo $group['course'].'-'.$group['profession']['0']['profession'];?></b>
        <?php } ?>
        </div>

        <div class='main_grid_content'>
            <div class='grid_st clearfix'>
                <div class=''>
                    <div class='form_box edit_ctt_wrap'>
                        <link href='/web/admin/timetable_files/subdomain.css' type='text/css' rel='stylesheet'>
                        <script type='text/javascript' src='/web/admin/timetable_files/e5039b7465f6.js'></script>
                        <form action='<?php \yii\helpers\Url::to('@web/site/index.php?r=admin/control/select-group-lesson')?>' method='post'>
                            <input type='hidden' name='urlurl' class='urlurl' value=''>
                            <input type='hidden' name='id_sinf' class='id_sinf' value='<?php echo $group['id_group'];?>'>
                            <div class='sbp_bb edit_ctt' id='edit_class_timetable'>
                                <?php $r=0; foreach($ms as $pow): $r++;?>

                                    <div class='edit_ctt_day'>
                                        <div class='ttb_day'><?php echo $pow['ruz'];?></div>
                                        <?php $s=0; foreach($pow['satr'] as $row): $s++;?>

                                           <div class='edit_ctt_lesson'>
                                                <span class='number'><?php echo $s; ?>.</span>
                                                <div id='edit_ctt_lesson_subjects_<?php echo $r;?>-<?php echo $s;?>' class='lesson_subjects'>
                                                    <div class='lesson_subject'>
                                                        <input type='hidden'  name='<?php echo $r;?>-<?php echo $s;?>_day' value='<?php echo $r;?>'>
                                                        <input type='hidden' name='<?php echo $r;?>-<?php echo $s;?>_number' value='<?php echo $s;?>'>

                                                        <?php if($row['id_fan']==0 && ($row['id_om']==0 || empty($row['id_om']))){?>
                                                            <input type='hidden' id='<?php echo $r;?>-<?php echo $s;?>_class_fan_id' name='<?php echo $r;?>-<?php echo $s;?>_class_fan_id' value='0'>
                                                            <input type='hidden' name='<?php echo $r;?>-<?php echo $s;?>-<?php echo $s;?>_class_omuzgor_id' value='0'>
                                                                    <span class='edit_ctt_subject'>
                                                                                <div class='col-sm-6'>
                                                                                    <a id='edit_ctt_subject_<?php echo $r;?>-<?php echo $s?>' not-hide='subjects_popup'
                                                                                       onclick='classTimetableEditor.openClassSubjectsPopup(this, <?php echo $r;?>, <?php echo $s;?>)'
                                                                                       class='not_assigned'>Интихоб нашудааст
                                                                                    </a>
                                                                                </div>

                                                                                <div class='col-sm-6'>
                                                                                    <a id='edit_ctt_subject_<?php echo $r;?>-<?php echo $s;?>-<?php echo $s;?>' not-hide='subjects_popup'
                                                                                       onclick='classTimetableEditor.openSubgroupsSubjectsPopup(this, <?php echo $r;?>, <?php echo $s;?>, <?php echo $s;?>)'
                                                                                       class='not_assigned'>Интихоб нашудааст
                                                                                    </a>
                                                                                </div>

                                                                            </span>
                                                        <?php } elseif($row['id_fan']!=0 && $row['id_om']==0) { ?>
                                                            <input type='hidden'  id='<?php echo $r;?>-<?php echo $s;?>_class_fan_id' name='<?php echo $r;?>-<?php echo $s;?>_class_fan_id' value='<?php echo $row['id_fan'];?>'>
                                                            <input type='hidden' name='<?php echo $r;?>-<?php echo $s;?>-<?php echo $s;?>_class_omuzgor_id' value='<?php echo $row['id_om'];?>'>

                                                            <span class='edit_ctt_subject'>
                                                                                <div class='col-sm-6'>
                                                                                    <a id='edit_ctt_subject_<?php echo $r;?>-<?php echo $s;?>' not-hide='subjects_popup'
                                                                                       onclick='classTimetableEditor.openClassSubjectsPopup(this, <?php echo $r;?>, <?php echo $s;?>)'
                                                                                       class=''><?php echo $row['fan'];?>
                                                                                    </a>
                                                                                </div>

                                                                                <div class='col-sm-6'>
                                                                                    <a id='edit_ctt_subject_<?php echo $r;?>-<?php echo $s;?>-<?php echo $s;?>' not-hide='subjects_popup'
                                                                                       onclick='classTimetableEditor.openSubgroupsSubjectsPopup(this, <?php echo $r;?>, <?php echo $s;?>, <?php echo $s;?>)'
                                                                                       class='not_assigned'>Интихоб нашудааст
                                                                                    </a>
                                                                                </div>
                                                                            </span>
                                                        <?php }
                                                                elseif($row['id_fan']==0 && $row['id_om']!=0) { ?>
                                                            <input type='hidden'  id='<?php echo $r;?>-<?php echo $s;?>_class_fan_id' name='<?php echo $r;?>-<?php echo $s;?>_class_fan_id' value='<?php echo $row['id_fan'];?>'>
                                                            <input type='hidden' name='<?php echo $r;?>-<?php echo $s;?>-<?php echo $s;?>_class_omuzgor_id' value='<?php echo $row['id_om'];?>'>

                                                            <span class='edit_ctt_subject'>
                                                                                <div class='col-sm-6'>
                                                                                    <a id='edit_ctt_subject_<?php echo $r;?>-<?php echo $s?>' not-hide='subjects_popup'
                                                                                       onclick='classTimetableEditor.openClassSubjectsPopup(this, <?php echo $r;?>, <?php echo $s;?>)'
                                                                                       class='not_assigned'>Интихоб нашудааст
                                                                                    </a>
                                                                                </div>

                                                                                 <div class='col-sm-6'>
                                                                                    <a id='edit_ctt_subject_<?php echo $r;?>-<?php echo $s;?>-<?php echo $s;?>' not-hide='subjects_popup'
                                                                                       onclick='classTimetableEditor.openSubgroupsSubjectsPopup(this, <?php echo $r;?>, <?php echo $s;?>, <?php echo $s;?>)'
                                                                                       class=''><?php echo $row['fio_om'];?>
                                                                                    </a>
                                                                                </div>
                                                                            </span>

                                                        <? } else
                                                        {?>
                                                         <input type='hidden'  id='<?php echo $r;?>-<?php echo $s;?>_class_fan_id' name='<?php echo $r;?>-<?php echo $s;?>_class_fan_id' value='<?php echo $row['id_fan'];?>'>
                                                            <input type='hidden' name='<?php echo $r;?>-<?php echo $s;?>-<?php echo $s;?>_class_omuzgor_id' value='<?php echo $row['id_om'];?>'>

                                                         <span class='edit_ctt_subject'>
                                                                                <div class='col-sm-6'>
                                                                                    <a id='edit_ctt_subject_<?php echo $r;?>-<?php echo $s;?>' not-hide='subjects_popup'
                                                                                       onclick='classTimetableEditor.openClassSubjectsPopup(this, <?php echo $r;?>, <?php echo $s;?>)'
                                                                                       class=''><?php echo $row['fan'];?>
                                                                                    </a>
                                                                                </div>


                                                                             <div class='col-sm-6'>
                                                                                    <a id='edit_ctt_subject_<?php echo $r;?>-<?php echo $s;?>-<?php echo $s;?>' not-hide='subjects_popup'
                                                                                       onclick='classTimetableEditor.openSubgroupsSubjectsPopup(this, <?php echo $r;?>, <?php echo $s;?>, <?php echo $s;?>)'
                                                                                       class=''><?php echo $row['fio_om'];?>
                                                                                    </a>
                                                                                </div>


                                                        <?}?>
                                                    </div>
                                                </div>
                                            </div><!--.edit_ctt_lesson-->
                                        <?php endforeach; ?>
                                    </div><!--.edit_ctt_day-->
                                <?php endforeach; ?>

                            </div><!--#edit_ctt-->

                            <div class='sbp'>

                            </div>
                        </form>

                        <div class='sch_pop2' id='popup_class_subjects' not-hide='subjects_popup' style='display: none;'>

                            <a class='close_link'>закрыть</a>
                        </div><!--#popup_class_subjects-->


                        <div class='sch_pop2' id='popup_omuz_subjects' not-hide='subjects_popup' style='display: none;'>

                            <a class='close_link'>закрыть</a>
                        </div><!--#popup_subgroups_subjects-->
                    </div><!--.edit_ctt_wrap-->
                </div>
            </div>
        </div><!-- .main_grid_content -->




<!-- PAGE CONTENT ENDS --><!-- PAGE CONTENT ENDS --><!-- PAGE CONTENT ENDS --><!-- PAGE CONTENT ENDS --><!-- PAGE CONTENT ENDS -->








