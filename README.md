# Remindy
A reminder program for big eyes

P.S : Latest Working Folder is remindy_v1



#SQL Query Updates

##1. Joining Three Tables 
------------------------
```sql
SELECT t_u.*, t_t.*
from tbl_user t_u
inner join tbl_user_has_task t_u_h_t on t_u_h_t.USERID=t_u.ID
inner join tbl_tasks t_t on t_u_h_t.TASKID=t_t.ID
```

