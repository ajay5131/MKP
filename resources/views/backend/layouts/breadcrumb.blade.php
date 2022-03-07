<div class="page-bar">
    <ul class="page-breadcrumb">
        <li> <a href="{{ route('admin.dashboard') }}">Home</a> <i class="fa fa-circle"></i> </li>
        <?php echo  (!empty($breadcrumbs['breadcrumb']) ? $breadcrumbs['breadcrumb'] : '') ?>
    </ul>
</div>
<h3 class="page-title"> 
    {{ (!empty($breadcrumbs['page_title']) ? $breadcrumbs['page_title'] : '') }}
    <small>{{ (!empty($breadcrumbs['active_page']) ? $breadcrumbs['active_page'] : '') }}</small> 
</h3>