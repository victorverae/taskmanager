<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/minimal.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/dashboard.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/yira.css">
</head>
<body>
<div class="">
</div>
<div class="dashboard">
<div class="container">
<div class="title">Tareas</div>
<div class="result">
<div>Tarea 1</div>
</div>
</div>
</div>
<table class="dashboard">
<thead>
<tr>
<th>Tareas</th><th>Dato</th>
</tr>
</thead>
<tbody>
<?php for($i=0;$i<5;$i++){echo "<tr><td>Tarea ".$i."</td><td>Resume</td></tr>";}?>
</tbody>
<tfoot>
</tfoot>
</table>

<div class="dashboard-item-header"><h3 id="gadget-10002-title" class="dashboard-item-title">Assigned to Me</h3><div class="gadget-menu"><ul><li><a href="#" id="gadget-10002-maximize" class="aui-icon maximize" title="Maximize">Maximize</a></li><li class="aui-dd-parent dd-allocated"><a id="undefined" class="aui-dd-trigger standard " href="#"><span>Gadget menu</span></a><ul class="aui-dropdown standard hidden"><li class="dropdown-item"><a class="item-link minimization" href="#">Minimize</a></li><li class="dropdown-item reload"><a class="item-link no_target" href="#">Refresh</a></li></ul></li></ul></div></div>
<table id="issuetable">
                        <thead>
        <tr class="rowHeader">
            
                                                                                        <th class="colHeaderLink sortable headerrow-issuetype" rel="issuetype:DESC" data-id="issuetype" onclick="window.document.location='https://pruebavvera.atlassian.net/secure/IssueNavigator.jspa?sorter/field=issuetype&amp;sorter/order=DESC'">
                                <span title="Sort By Issue Type">T</span>
                            </th>
                                                                        
                                                                                        <th class="colHeaderLink sortable headerrow-issuekey" rel="issuekey:ASC" data-id="issuekey" onclick="window.document.location='https://pruebavvera.atlassian.net/secure/IssueNavigator.jspa?sorter/field=issuekey&amp;sorter/order=ASC'">
                                <span title="Sort By Key">Key</span>
                            </th>
                                                                        
                                                                                        <th class="colHeaderLink sortable headerrow-summary" rel="summary:ASC" data-id="summary" onclick="window.document.location='https://pruebavvera.atlassian.net/secure/IssueNavigator.jspa?sorter/field=summary&amp;sorter/order=ASC'">
                                <span title="Sort By Summary">Summary</span>
                            </th>
                                                                        
                                                            
                                                            <th class="active sortable descending headerrow-priority" rel="priority:ASC" data-id="priority" onclick="window.document.location='https://pruebavvera.atlassian.net/secure/IssueNavigator.jspa?sorter/field=priority&amp;sorter/order=ASC'" title="Descending order - Click to sort in ascending order">
                                    <span title="Sort By Priority">P</span>
                                </th>
                                                                                                                                <th class="colHeaderLink headerrow-actions">
                    
                </th>
                    </tr>
    </thead>
    <tbody>
                    

                <tr id="issuerow10000" rel="10000" data-issuekey="DEMO-1" class="issuerow">
                                            <td class="issuetype">    <a class="issue-link" data-issue-key="DEMO-1" href="https://pruebavvera.atlassian.net/browse/DEMO-1" target="_parent"> <img src="https://pruebavvera.atlassian.net/images/icons/issuetypes/task.png" height="16" width="16" border="0" align="absmiddle" alt="Task" title="Task - A task that needs to be done."></a></td>
                                            <td class="issuekey">

    <a class="issue-link" data-issue-key="DEMO-1" href="https://pruebavvera.atlassian.net/browse/DEMO-1">DEMO-1</a>
</td>
                                            <td class="summary"><p>
                <a class="issue-link" data-issue-key="DEMO-1" href="https://pruebavvera.atlassian.net/browse/DEMO-1">What is an issue?</a>
    </p>
</td>
                                            <td class="priority">            <img src="https://pruebavvera.atlassian.net/images/icons/priorities/major.png" height="16" width="16" border="0" align="absmiddle" alt="Major" title="Major - Major loss of function.">
    </td>
                            <td class="issue_actions">    <div class="action-dropdown aui-dd-parent">
        <a class="aui-dropdown-trigger aui-dd-link icon-tools-small issue-actions-trigger" id="actions_10000" title="Actions (Type . to access issue actions)" href="https://pruebavvera.atlassian.net/rest/api/1.0/issues/10000/ActionsAndOperations?atl_token=B1SL-VOAM-FA3O-LRKB|ea928980b680817429982a53cfb9b6399d0222f1|lin">
            <span>
                <em>Actions</em>
            </span>
        </a>
    </div>
</td>
            </tr>


                <tr id="issuerow10001" rel="10001" data-issuekey="DEMO-2" class="issuerow">
                                            <td class="issuetype">    <a class="issue-link" data-issue-key="DEMO-2" href="https://pruebavvera.atlassian.net/browse/DEMO-2"> <img src="https://pruebavvera.atlassian.net/images/icons/issuetypes/task.png" height="16" width="16" border="0" align="absmiddle" alt="Task" title="Task - A task that needs to be done."></a></td>
                                            <td class="issuekey">

    <a class="issue-link" data-issue-key="DEMO-2" href="https://pruebavvera.atlassian.net/browse/DEMO-2">DEMO-2</a>
</td>
                                            <td class="summary"><p>
                <a class="issue-link" data-issue-key="DEMO-2" href="https://pruebavvera.atlassian.net/browse/DEMO-2">Changing an issue's status</a>
    </p>
</td>
                                            <td class="priority">            <img src="https://pruebavvera.atlassian.net/images/icons/priorities/major.png" height="16" width="16" border="0" align="absmiddle" alt="Major" title="Major - Major loss of function.">
    </td>
                            <td class="issue_actions">    <div class="action-dropdown aui-dd-parent">
        <a class="aui-dropdown-trigger aui-dd-link icon-tools-small issue-actions-trigger" id="actions_10001" title="Actions (Type . to access issue actions)" href="https://pruebavvera.atlassian.net/rest/api/1.0/issues/10001/ActionsAndOperations?atl_token=B1SL-VOAM-FA3O-LRKB|ea928980b680817429982a53cfb9b6399d0222f1|lin">
            <span>
                <em>Actions</em>
            </span>
        </a>
    </div>
</td>
            </tr>


                <tr id="issuerow10002" rel="10002" data-issuekey="DEMO-3" class="issuerow">
                                            <td class="issuetype">    <a class="issue-link" data-issue-key="DEMO-3" href="https://pruebavvera.atlassian.net/browse/DEMO-3"> <img src="https://pruebavvera.atlassian.net/images/icons/issuetypes/task.png" height="16" width="16" border="0" align="absmiddle" alt="Task" title="Task - A task that needs to be done."></a></td>
                                            <td class="issuekey">

    <a class="issue-link" data-issue-key="DEMO-3" href="https://pruebavvera.atlassian.net/browse/DEMO-3">DEMO-3</a>
</td>
                                            <td class="summary"><p>
                <a class="issue-link" data-issue-key="DEMO-3" href="https://pruebavvera.atlassian.net/browse/DEMO-3">Keyboard shortcuts</a>
    </p>
</td>
                                            <td class="priority">            <img src="https://pruebavvera.atlassian.net/images/icons/priorities/major.png" height="16" width="16" border="0" align="absmiddle" alt="Major" title="Major - Major loss of function.">
    </td>
                            <td class="issue_actions">    <div class="action-dropdown aui-dd-parent">
        <a class="aui-dropdown-trigger aui-dd-link icon-tools-small issue-actions-trigger" id="actions_10002" title="Actions (Type . to access issue actions)" href="https://pruebavvera.atlassian.net/rest/api/1.0/issues/10002/ActionsAndOperations?atl_token=B1SL-VOAM-FA3O-LRKB|ea928980b680817429982a53cfb9b6399d0222f1|lin">
            <span>
                <em>Actions</em>
            </span>
        </a>
    </div>
</td>
            </tr>


                <tr id="issuerow10003" rel="10003" data-issuekey="DEMO-4" class="issuerow">
                                            <td class="issuetype">    <a class="issue-link" data-issue-key="DEMO-4" href="https://pruebavvera.atlassian.net/browse/DEMO-4"> <img src="https://pruebavvera.atlassian.net/images/icons/issuetypes/task.png" height="16" width="16" border="0" align="absmiddle" alt="Task" title="Task - A task that needs to be done."></a></td>
                                            <td class="issuekey">

    <a class="issue-link" data-issue-key="DEMO-4" href="https://pruebavvera.atlassian.net/browse/DEMO-4">DEMO-4</a>
</td>
                                            <td class="summary"><p>
                <a class="issue-link" data-issue-key="DEMO-4" href="https://pruebavvera.atlassian.net/browse/DEMO-4">Editing issues</a>
    </p>
</td>
                                            <td class="priority">            <img src="https://pruebavvera.atlassian.net/images/icons/priorities/major.png" height="16" width="16" border="0" align="absmiddle" alt="Major" title="Major - Major loss of function.">
    </td>
                            <td class="issue_actions">    <div class="action-dropdown aui-dd-parent">
        <a class="aui-dropdown-trigger aui-dd-link icon-tools-small issue-actions-trigger" id="actions_10003" title="Actions (Type . to access issue actions)" href="https://pruebavvera.atlassian.net/rest/api/1.0/issues/10003/ActionsAndOperations?atl_token=B1SL-VOAM-FA3O-LRKB|ea928980b680817429982a53cfb9b6399d0222f1|lin">
            <span>
                <em>Actions</em>
            </span>
        </a>
    </div>
</td>
            </tr>


                <tr id="issuerow10004" rel="10004" data-issuekey="DEMO-5" class="issuerow">
                                            <td class="issuetype">    <a class="issue-link" data-issue-key="DEMO-5" href="https://pruebavvera.atlassian.net/browse/DEMO-5"> <img src="https://pruebavvera.atlassian.net/images/icons/issuetypes/task.png" height="16" width="16" border="0" align="absmiddle" alt="Task" title="Task - A task that needs to be done."></a></td>
                                            <td class="issuekey">

    <a class="issue-link" data-issue-key="DEMO-5" href="https://pruebavvera.atlassian.net/browse/DEMO-5">DEMO-5</a>
</td>
                                            <td class="summary"><p>
                <a class="issue-link" data-issue-key="DEMO-5" href="https://pruebavvera.atlassian.net/browse/DEMO-5">Searching</a>
    </p>
</td>
                                            <td class="priority">            <img src="https://pruebavvera.atlassian.net/images/icons/priorities/major.png" height="16" width="16" border="0" align="absmiddle" alt="Major" title="Major - Major loss of function.">
    </td>
                            <td class="issue_actions">    <div class="action-dropdown aui-dd-parent">
        <a class="aui-dropdown-trigger aui-dd-link icon-tools-small issue-actions-trigger" id="actions_10004" title="Actions (Type . to access issue actions)" href="https://pruebavvera.atlassian.net/rest/api/1.0/issues/10004/ActionsAndOperations?atl_token=B1SL-VOAM-FA3O-LRKB|ea928980b680817429982a53cfb9b6399d0222f1|lin">
            <span>
                <em>Actions</em>
            </span>
        </a>
    </div>
</td>
            </tr>


                <tr id="issuerow10005" rel="10005" data-issuekey="DEMO-6" class="issuerow">
                                            <td class="issuetype">    <a class="issue-link" data-issue-key="DEMO-6" href="https://pruebavvera.atlassian.net/browse/DEMO-6"> <img src="https://pruebavvera.atlassian.net/images/icons/issuetypes/task.png" height="16" width="16" border="0" align="absmiddle" alt="Task" title="Task - A task that needs to be done."></a></td>
                                            <td class="issuekey">

    <a class="issue-link" data-issue-key="DEMO-6" href="https://pruebavvera.atlassian.net/browse/DEMO-6">DEMO-6</a>
</td>
                                            <td class="summary"><p>
                <a class="issue-link" data-issue-key="DEMO-6" href="https://pruebavvera.atlassian.net/browse/DEMO-6">What's next?</a>
    </p>
</td>
                                            <td class="priority">            <img src="https://pruebavvera.atlassian.net/images/icons/priorities/major.png" height="16" width="16" border="0" align="absmiddle" alt="Major" title="Major - Major loss of function.">
    </td>
                            <td class="issue_actions">    <div class="action-dropdown aui-dd-parent">
        <a class="aui-dropdown-trigger aui-dd-link icon-tools-small issue-actions-trigger" id="actions_10005" title="Actions (Type . to access issue actions)" href="https://pruebavvera.atlassian.net/rest/api/1.0/issues/10005/ActionsAndOperations?atl_token=B1SL-VOAM-FA3O-LRKB|ea928980b680817429982a53cfb9b6399d0222f1|lin">
            <span>
                <em>Actions</em>
            </span>
        </a>
    </div>
</td>
            </tr>
                </tbody>
				</table>
<div class="dashboard-item-content"><form action="https://pruebavvera.atlassian.net/rest/dashboards/1.0/10000/gadget/10002/prefs" class="aui userpref-form hidden" method="post" id="gadget-10002-edit"><fieldset><legend><span class="dashboard-item-title">Assigned to Me</span> Preferences</legend><input id="gadget-10002-form-isConfigured-pref" type="hidden" class="hidden" value="true" name="up_isConfigured"><input id="gadget-10002-form-sortColumn-pref" type="hidden" class="hidden" name="up_sortColumn"><input id="gadget-10002-form-num-pref" type="hidden" class="hidden" value="10" name="up_num"><input id="gadget-10002-form-refresh-pref" type="hidden" class="hidden" value="false" name="up_refresh"><input id="gadget-10002-form-columnNames-pref" type="hidden" class="hidden" value="--Default--" name="up_columnNames"></fieldset><div class="buttons-container submit"><input type="submit" class="submit" value="Save" name="save" id="gadget-10002-save"><input type="reset" class="cancel" value="Cancel" name="reset" id="gadget-10002-cancel"></div></form><iframe id="gadget-10002" class="gadget-iframe" name="gadget-10002" src="https://pruebavvera.atlassian.net/plugins/servlet/gadgets/ifr?container=atlassian&amp;mid=10002&amp;country=US&amp;lang=en&amp;view=default&amp;view-params=%7B%22writable%22%3A%22true%22%7D&amp;st=atlassian%3A02OXIduI13t%2FC1mg8uPUJdw%2FR0GL4YQ3TbRTMwBO%2BwD6Q9feoUdMrE943V7rZ8Vt%2BYSFqdXgH0Ao%2BCj%2FoQ9IU6iaPeFuU6iUgEJx2c464Rs%2F3A%2F3xgZwDTXu%2B8OQs2BsvtbRTcSJEh0KskjWbDeJf8%2BjkLQe%2BrQ3fzatEVrBWOgGxWLJsPPZ35SnLNSTO0A2rP2TjsZYsSRuQxFRj6IbweUcv8FwJf919QWMjiQ35V%2Bpq5DPJyP7UvApfcSM4Wb3Qm1dvoF5m0XnQE1F7dl%2BT4xLkOzKMEEech69ZRBzjGWHaRmopBAyrTGF80DCC9SgrEzFnA%3D%3D&amp;up_num=10&amp;up_isConfigured=true&amp;up_columnNames=--Default--&amp;up_sortColumn=&amp;up_refresh=false&amp;url=https%3A%2F%2Fpruebavvera.atlassian.net%2Frest%2Fgadgets%2F1.0%2Fg%2Fcom.atlassian.jira.gadgets%3Aassigned-to-me-gadget%2Fgadgets%2Fassigned-to-me-gadget.xml&amp;libs=auth-refresh#rpctoken=2421740" height="237" width="100%" scrolling="no" frameborder="no" style="height: 237px;"></iframe></div>






<div class="gadget color1" id="gadget-10002-renderbox" style="left: 51.4536230541142%; top: 70px; width: 45.9599703484062%; height: auto;"><div class="dashboard-item-frame gadget-container" id="gadget-10002-chrome"><div class="dashboard-item-header"><h3 id="gadget-10002-title" class="dashboard-item-title">Assigned to Me</h3><div class="gadget-menu"><ul><li><a href="#" id="gadget-10002-maximize" class="aui-icon maximize" title="Maximize">Maximize</a></li><li class="aui-dd-parent dd-allocated"><a id="undefined" class="aui-dd-trigger standard " href="#"><span>Gadget menu</span></a><ul class="aui-dropdown standard hidden"><li class="dropdown-item"><a class="item-link minimization" href="#">Minimize</a></li><li class="dropdown-item reload"><a class="item-link no_target" href="#">Refresh</a></li><li class="dropdown-item configure"><a class="item-link no_target" href="#">Edit</a></li></ul></li></ul></div></div><div class="dashboard-item-content"><form action="https://pruebavvera.atlassian.net/rest/dashboards/1.0/10000/gadget/10002/prefs" class="aui userpref-form hidden" method="post" id="gadget-10002-edit"><fieldset><legend><span class="dashboard-item-title">Assigned to Me</span> Preferences</legend><input id="gadget-10002-form-isConfigured-pref" type="hidden" class="hidden" value="true" name="up_isConfigured"><input id="gadget-10002-form-sortColumn-pref" type="hidden" class="hidden" name="up_sortColumn"><input id="gadget-10002-form-num-pref" type="hidden" class="hidden" value="10" name="up_num"><input id="gadget-10002-form-refresh-pref" type="hidden" class="hidden" value="false" name="up_refresh"><input id="gadget-10002-form-columnNames-pref" type="hidden" class="hidden" value="--Default--" name="up_columnNames"></fieldset><div class="buttons-container submit"><input type="submit" class="submit" value="Save" name="save" id="gadget-10002-save"><input type="reset" class="cancel" value="Cancel" name="reset" id="gadget-10002-cancel"></div></form><iframe id="gadget-10002" class="gadget-iframe" name="gadget-10002" src="https://pruebavvera.atlassian.net/plugins/servlet/gadgets/ifr?container=atlassian&amp;mid=10002&amp;country=US&amp;lang=en&amp;view=default&amp;view-params=%7B%22writable%22%3A%22true%22%7D&amp;st=atlassian%3A02OXIduI13t%2FC1mg8uPUJdw%2FR0GL4YQ3TbRTMwBO%2BwD6Q9feoUdMrE943V7rZ8Vt%2BYSFqdXgH0Ao%2BCj%2FoQ9IU6iaPeFuU6iUgEJx2c464Rs%2F3A%2F3xgZwDTXu%2B8OQs2BsvtbRTcSJEh0KskjWbDeJf8%2BjkLQe%2BrQ3fzatEVrBWOgGxWLJsPPZ35SnLNSTO0A2rP2TjsZYsSRuQxFRj6IbweUcv8FwJf919QWMjiQ35V%2Bpq5DPJyP7UvApfcSM4Wb3Qm1dvoF5m0XnQE1F7dl%2BT4xLkOzKMEEech69ZRBzjGWHaRmopBAyrTGF80DCC9SgrEzFnA%3D%3D&amp;up_num=10&amp;up_isConfigured=true&amp;up_columnNames=--Default--&amp;up_sortColumn=&amp;up_refresh=false&amp;url=https%3A%2F%2Fpruebavvera.atlassian.net%2Frest%2Fgadgets%2F1.0%2Fg%2Fcom.atlassian.jira.gadgets%3Aassigned-to-me-gadget%2Fgadgets%2Fassigned-to-me-gadget.xml&amp;libs=auth-refresh#rpctoken=2421740" height="237" width="100%" scrolling="no" frameborder="no" style="height: 237px;"></iframe></div></div></div>
</body>
</html>