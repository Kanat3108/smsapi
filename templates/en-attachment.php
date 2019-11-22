
    <div class="container">
        <div class="paper mb-5">
            <div class="content">
                <h1 class="content__title text-center mb-5">Application<br/>for classification as a professional client.</h1>
                <p class="content__text mb-3">I, the undersigned client, categorized by Coverdeal Holdings Ltd ("the Company") as a retail client, in accordance with the Company's client categorization policy  (<a href="(https://globtrex.com/en/about-us/policies/client-categorisation/)" target="_blank">link</a>)</p>
                <p class="content__text mb-3">and Act 87 (I) / 2017 on the provision of investment services, investment activities and the operation of regulated markets, I request that the company treat me as a professional client. </p>
     
                <p class="content__text mb-3">I have read, understood and agreed to the Company's policy on client categorization with respect to the protection and compensation rights that I may lose, and I am aware of the consequences of the loss.</p>
                <p class="content__text mb-3">As part of my application, I request to be treated as a professional client and declare the facts below. I declare that I will provide any additional information or documentation that will be required for the assessment. At the same time, I accept that the company will conduct its own internal assessment.</p>
                <p class="content__text mb-4">I undertake to notify the Company immediately of any changes to the information below that may affect this assessment or cause the information herein to be false, incomplete or unusable.</p>
                <h2 class="content__title text-center mb-3">CLIENT DECLARATION AND WARRANTIES:  </h2>
                <p class="content__text mb-3">
                    <span class="content__text--bold">I, </span>
                    <b><?=$user?></b>
                    <span class="content__text--bold"> warrant that I/this entity/we satisfy at least two of the three criteria listed below. </span>
                </p>
                <p class="content__text content__text--bold mb-2">Trade size & volume:</p>
                <div class="content__checkbox mb-3 d-flex">

                    <input type="checkbox" id="checkbox-3" class="d-none" name="trade" <?=($trade=='yes')?('checked'):('')?>>
                    <label for="checkbox-3"></label>
                    <label for="checkbox-3">You have carried out transactions, in significant size, on the relevant market at an average frequency of 10 per quarter over the previous 4 quarters. *   </label>
                </div>
                <p class="content__text content__text--bold mb-2">Size of portfolio: </p>
                <div class="content__checkbox mb-3 d-flex">
                    <input type="checkbox" id="checkbox-4" class="d-none" name="portfolio" <?=($portfolio=='yes')?('checked'):('')?>>
                    <label for="checkbox-4"></label>
                    <label for="checkbox-4">The size of your financial instrument portfolio, defined as including cash deposits AND financial instruments, exceeds EUR 500,000. ** </label>
                </div>
                <p class="content__text content__text--bold mb-2">Professional Experience </p>
                <div class="content__checkbox mb-3 d-flex">
                    <input type="checkbox" id="checkbox-5" class="d-none" name="experience" <?=($experience=='yes')?('checked'):('')?>>
                    <label for="checkbox-5"></label>
                    <label for="checkbox-5">You work or have worked in the financial sector for at least one year in a professional position, which requires knowledge of the transaction or services envisaged.  </label>
                </div>
                <p class="content__text content__text--sm">*Significant size trades are classified as having concluded transactions with an equivalent value of Eur25,000 per transaction in the case of nonleveraged transactions (equities) or a nominal value of Eur100,000 per transaction in the case of leveraged transactions (for forex, indices and commodities). </p>
                <p class="content__text content__text--sm mb-3">**(Acceptable examples of savings and investments: Cash savings, stock portfolio, stocks and shares ISA, trading accounts, mutual funds, SIPP (excluding non-financial instruments). Unacceptable examples of savings and investments: Company pension, non-tradeable assets, property, luxury cars, jewellery.) </p>
                <p class="content__text mb-4">Furthermore, I confirm that I wish to be treated as a professional client generally by Coverdeal Limited. I have read and understood the written warning below from Coverdeal Ltd regarding the protections and compensation rights that I may lose, and I am aware of the consequences of losing such protections.</p>
                <h2 class="content__title text-center mb-4">WARNING REGARDING PROFESSIONAL VS   <br/>RETAIL CATEGORISATIONS: </h2>
                <p class="content__text mb-3">There is no change in the tax status of the client or any additional costs when changing the categorization to a professional client. Professional client money will always be separated from our own money.</p>
                <p class="content__text mb-3">As a professional client you will lose the following protection:</p>
                <p class="content__text mb-2 pl-4">
                    - Our communications, including additional information about financial instruments and the risks associated with them, information about the company itself and about costs, commissions, fees and payments that will not be subject to all non-professional regulatory requirements. Eligibility for compensation from the Investor Compensation Fund
                </p>
                <p class="content__text content__text--bold mb-3">Declaration of consent </p>
                <p class="content__text mb-3">I agree to the classification as a professional client. I have taken note that this means that I am subject to lower protection provisions compared to private clients. </p>
                <p class="content__text mb-3">With my signature I also confirm that I have read and understand the contents of the information provided and that I agree with the points mentioned above. </p>

                
                    <div class="d-flex flex-column flex-lg-row justify-content-between mb-5">
                        <div class="mb-4 mb-lg-0">
                            <span class="content__text">Date:  <?=$date?></span>
                        </div>
                        <div>
                            <span class="content__text">Full Name: <?=$user?> </span>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-lg-row  mb-5">
                        <div id="phone-wrap">
                            <span class="content__text">Phone:<?=$phone?> </span>
                           
                        </div>
                      
                    </div>
                    
            </div>
        </div>
    </div>
