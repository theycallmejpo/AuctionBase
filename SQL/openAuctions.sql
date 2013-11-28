PRAGMA foreign_keys = ON;

drop view if exists openAuctions;

create view openAuctions as
select ItemID 
from Item, Time t
where Started <= t.current_datetime and Ends >= t.current_datetime and ( Currently < Buy_Price or Buy_Price is NULL );


