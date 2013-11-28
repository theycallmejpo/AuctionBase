
-- description: check to see auction is open and dates are correct

PRAGMA foreign_keys = ON;

drop trigger if exists bidOnOpenItems;
drop trigger if exists bidWithinItemDates;
drop trigger if exists bidHigherThanMaxBid;

create trigger bidOnOpenItems
after insert on Bid
for each row
when not exists ( select * from openAuctions where ItemID = New.ItemID ) and
					exists ( select * from Item where ItemID = New.ItemID  )
begin
	select raise(rollback, 'The bid is made on a closed auction');
end;

create trigger bidWithinItemDates
after insert on Bid
for each row
when 	New.Time > ( select Ends from Item where Item.ItemID = New.ItemID ) or
			New.Time < ( select Started from Item where Item.ItemID = New.ItemID )
begin
	select raise(rollback, 'The bid is not within the Item auction dates');
end;

create trigger bidHigherThanMaxBid
after insert on Bid
for each row
when New.Amount <= ( select Currently from Item where ItemID = New.ItemID )
begin
	select raise(rollback, 'The bid is not higher than the highest bid');
end;

select *
from Item i
where Currently <> (	select max(Amount)
											from Bid b
											where b.ItemID = i.ItemID );

