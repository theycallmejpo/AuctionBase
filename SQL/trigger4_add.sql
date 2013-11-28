-- Trigger to make sure current time is not being set to the past

PRAGMA foreign_keys = ON;

drop trigger if exists noPastTimeUpdate;

create trigger noPastTimeUpdate
after update on Time
for each row
when New.current_datetime < Old.current_datetime
begin
	select raise(rollback, 'New set time must not be in the past');
end;