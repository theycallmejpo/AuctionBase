///////////////////////////
//      README.txt       //  
///////////////////////////

1. Not entering the contest

2. When the user lands on the home page, home.php, there are four things to notice:
    a. Header: the header contains rapid links to navigate to the search functionality and to sign up, and back home at all times.
    b. Current Time: The current time is displayed at all times under the main header for quick reference. Also, a link is always next to it which allows users to change the current time.
    c. Jumbotron: A quick overview of what AuctionBase is all about and a sign up button.
    d. Links and descriptions of features: Under the jumbotron, there are links and descriptions to the functionalities offered in the site, such as browsing, bidding, checking past winners, etc.

    - A user can change the current time by clicking the change button next to the current time.
    - A user can enter bids by first, searching for an item, clicking on its link, and if it's an open bid, then there is a form to enter a bid.
    - Automatic auction closing is done behind the scenes whenever auctions' bid is equal or higher to its buy price, or when it has already ended.
    - All closed auctions display the auction winner in their description, if there is one.
    - By clicking on the Search link on the top, or by clicking 'Find Auctions that Match You', a user can search for Items of their preference.
    - In this same form, users can just find open and/or closed auctions.

3.	A user can search by ItemID, in which case it doesn't matter what else he inputs since the ID is most specific. This can also be done from the home page directly. Also, the user can search by a substring of a category of his/her choice, by minimum price and both open and/or closed auctions. Results are shown below the search form.

4.	There are helpful error and success messages with any post form to give the user a better experience. Also, I added the capability of creating your own account which allows new users to bid on auctions. Sign up form makes location and country fields required in order to allow them to bid. This can be accessed by clicking on the sign up link in the header or in the home page's jumbotron.

