    <!--Common hero Section Starts -->
    <section class="cmn_heros pb-120 pt-120">
        <div class="container">
            <div class="row justify-content-center mt-5 mt-md-8 mt-lg-0">
                <div class="col-xxl-6">
                    <div class="cmn_heros__title text-center pt-15 pt-lg-6">
                        <h1 class="display-three mb-5 mb-md-7 wow fadeInUp">Our Pricing Plan</h1>
                        <p class="roboto wow fadeInUp"> Discover our unbeatable pricing plan, offering the perfect balance of value
                            and features, tailored to meet your unique needs in Coiner Website.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Common hero Section Ends -->
    <!-- Pricing Plan Section Starts Starts -->
    <section class="pricing_plan pt-120 pb-120 bg5-color">
        <div class="container">
            <div class="row">
                    <div class="col-md-12">
                        <div class="abt-info">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <tbody><tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>PB</th>
                                    </tr>
                                    <?php
                                    $s=1;
                                    foreach($package as $key=>$val)
                                    {
                                    ?>
                                    <tr>
                                        <td><?php echo $s;?></td>
                                        <td><?php echo $val->title;?></td>
                                        <td><?php echo currency().$val->amount;?></td>
                                        <td><?php echo $val->pv;?></td>
                                    </tr>
                                    <?php
                                    $s++;
                                    }
                                    ?>
                                    <!--<tr>
                                        <td>2</td>
                                        <td>Apprentice</td>
                                        <td>$17.5</td>
                                        <td>15</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Amateur</td>
                                        <td>$27.5</td>
                                        <td>25</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Intern</td>
                                        <td>$57.5</td>
                                        <td>50</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Starter</td>
                                        <td>$110</td>
                                        <td>100</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Learning</td>
                                        <td>$267</td>
                                        <td>250</td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>Trainers</td>
                                        <td>$537</td>
                                        <td>500</td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>Professional</td>
                                        <td>$1070</td>
                                        <td>1000</td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>Business</td>
                                        <td>$5350</td>
                                        <td>5000</td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>Picnic Life</td>
                                        <td>$10100</td>
                                        <td>10000</td>
                                    </tr>-->
                                </tbody></table>
                            </div>
                        </div>
                    </div>
                    
                </div>
        </div>
    </section>
    <!-- Pricing Plan Section Starts Ends -->
    <style>
    .table-striped>tbody>tr:nth-of-type(odd)>* {
    --bs-table-accent-bg: var(--bs-table-striped-bg);
    color: #ffffff;
}
.table-hover>tbody>tr:hover>* {
    --bs-table-accent-bg: var(--bs-table-hover-bg);
    color: #ffffff;
}
        tr:nth-child(odd) {
        color: #ffffff; /* Light gray */
    }
    tr:nth-child(even) {
        color: #ffffff; /* White */
    }
    </style>
    