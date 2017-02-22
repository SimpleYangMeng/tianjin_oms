<?php /* Smarty version Smarty-3.1.13, created on 2016-02-17 13:59:05
         compiled from "D:\www\tianjin_1\oms\branches\main\application\modules\default\views\test\api.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3066356c40c29f23f90-40955348%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '395b90806062f5be8510513da69f947cdd017de4' => 
    array (
      0 => 'D:\\www\\tianjin_1\\oms\\branches\\main\\application\\modules\\default\\views\\test\\api.tpl',
      1 => 1455677484,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3066356c40c29f23f90-40955348',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'method' => 0,
    'item' => 0,
    'opType' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_56c40c2a0a1637_32539483',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56c40c2a0a1637_32539483')) {function content_56c40c2a0a1637_32539483($_smarty_tpl) {?><style text='text/css'>
   .left-td{
        text-align:right;
        width:400px;
        height:35px;
    }
    .right-td{
        text-align:left;
        height:35px;
    }
    #result{
        border:1px solid #CCCCCC;
        min-height:300px;
        width:600px;
    }
    .pd{
        border:1px solid #CCCCCC;
        margin-top:15px;
        width:1100px;
    }
</style>
<script type="text/javascript" src="/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript">
    $(function(){
        $('#method').change(function(){
            if($('#opType option:selected').val()!='' && $(this).val()!=''){
                getParam($(this).val(),$('#opType option:selected').val());
                if($(this).val()=='Waybill') {
                    $('#opType').append('<option value="UpdateStatus">UpdateStatus</option>');
                }else{
                    $('#opType option[value="UpdateStatus"]').remove();
                }
            }
            $('#opType option').first().select();
        })

        $('#opType').change(function(){
            if($('#method option:selected').val()!='' && $(this).val()!=''){
                getParam($('#method option:selected').val(),$(this).val());
            }
        })

        $('#submitForm').click(function(){
            $.ajax({
                type:'post',
                dataType:'json',
                async:false,
                url:'/default/test/api-test',
                data:$('#requestForm').serialize(),
                success:function(json){
                    var html = createXMLHtml(json);
                    $('#result').html(html);
                }
            })
        });

        $('.add').live('click',function(){
            var k = $(this).attr('k');//key
            var cl = $(this).parent().parent().clone();
            var ip = cl.find('input');
            var s = $('.'+k).last().attr('s');//index
            var ns = parseInt(s)+1;
            $.each(ip,function(){
                if($(this).attr('type')=='button'){
                    return;
                }
                $(this).val('');
                $(this).attr('s',ns);
                $(this).attr('name',k+'['+ns+']['+$(this).attr('i')+']')
            })
            $(cl).attr('s',ns);
            $('.'+k+':last').after(cl);
        })

        $('.remove').live('click',function(){
            if($('.'+$(this).attr('k')).length==1){
                return;
            }
            $(this).parent().parent().remove();
        })
    })

    function createXMLHtml(data){
        var html = '';
        for(var key in data){
            html += '&lt'+key+'&gt';
            if(typeof data[key] == 'object'){
                html += '</br>';
                html += createXMLHtml(data[key]);
            }else{
                html += data[key];
            }
            html += '&lt/'+key+'&gt</br>';
        }
        return html;
    }

    
    function getParam() {
        $.ajax({
            type:'post',
            dataType:'json',
            async:false,
            url:'/default/test/get-param',
            data:{method:$('#method option:selected').val(),opType:$('#opType option:selected').val(),},
            success:function(json){
                if(json){
                    var html = '<table>';
                    if(typeof json.form != 'undefined'){
                        var num = 1;
                        var len =json.form.length;
                        $.each(json.form,function(k,v){
                                if(num==1 || num%2==1){
                                    html += '<tr>';
                                }
                                html += '<td class="left-td">'+v+'('+k+'): </td>';
                                html += '<td class="right-td"><input type="text" name="'+k+'" value=""></td>';
                                if(num%2==0 || num==len){
                                    html += '</tr>';
                                }
                                ++num;
                        });
                    }
                    html += '</table>';

                    $('#pb').html(html);

                    html = '';
                    if(typeof json.body != 'undefined'){
                        $.each(json.body,function(k,v){
                            var num = 1;
                            html += '<div class="pd '+k+'" s="'+0+'" >';
                            html += '<div style="text-align:right;width:1100px;"><input type="button" value="添加" class="add" k="'+k+'"><input type="button" value="删除" class="remove" k="'+k+'"></div>'
                            html += '<table>';
                            $.each(v,function(j,i){
                                if(num==1 || num%2==1){
                                    html += '<tr>';
                                }
                                html += '<td class="left-td">'+i+'('+j+'): </td>';
                                html += '<td class="right-td"><input type="text" name="'+k+'[0]['+j+']" value="" k="'+k+'" i="'+i+'" s="0"></td>';
                                if(num%2==0 || num==len){
                                    html += '</tr>';
                                }
                                ++num;
                            });
                            html += '</table>';
                            html += '</div>'
                        })
                    }

                    $('#pd').html(html);
                }
            }
        })
    }
</script>

<form id="requestForm" action="/default/test/api-test" method="post">
    <p><h5>请求信息：</h5></p>
    <div id="pf">
        <table>
            <tr>
                <td class="left-td">method:</td>
                <td class="right-td">
                    <select name="method" id="method">
                        <option value="">请选择</option>
                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['method']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="left-td">opType:</td>
                <td class="right-td">
                    <select name="opType" id="opType">
                        <option value="">请选择</option>
                        <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['opType']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['item']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="left-td">customerCode:</td>
                <td class="right-td">
                    <input type="text" name="customerCode" value="">
                </td>
            </tr>
            <tr>
                <td class="left-td">accountCode:</td>
                <td class="right-td">
                    <input type="text" name="accountCode" value="">
                </td>
            </tr>
            <tr>
                <td class="left-td">appToken:</td>
                <td class="right-td">
                    <input type="text" name="appToken" value="">
                </td>
            </tr>
            <tr>
                <td class="left-td">appKey:</td>
                <td class="right-td">
                    <input type="text" name="appKey" value="">
                </td>
            </tr>
        </table>
    </div>
    <div id="pb">
        
    </div>
    <div id="pd">
    </div>
    <div style="margin-left:500px;"><input type="button" value="提交" id="submitForm"></div>
    <p><h5>返回结果：</h5></p>
    <div id="result">
    </div>
</form><?php }} ?>