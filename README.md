# APIFB

Data parser for FB API to work with Keitaro/Binom/Voluum/etc.

# Installation

1. Clone APIFB to to trackers installation folder:
   - **Keitaro:** `/var/www/keitaro`
   - **Binom:** `/var/www/binom`
   - **Voluum:** _Needs to be installed on the separate server_
  
    As a result, APIFB should be available at `http://YOUR_TRACKER_IP/apifb/stats.php`

2. Apply 0777 permissions to the `apifb` folder and its files.

3. Empty all the logs using the Dashboard: `http://YOUR_TRACKER_IP/apifb/stats.php` 
   
   Click `Clear` on each log. `Last Cleared` date should appear. If not - check file permissions.

4. Add traffic source to the tracker:
   - **Keitaro:**
  
     Select `Facebook.com` as a template. Rename to `APIFB` and enable postbacks for lead and sale events.
     
     Link: `http://127.0.0.1/apifb/{status}.php?sub_id_10={sub_id_10}&sub_id_11={sub_id_11}&sub_id_12={sub_id_12}&sub_id_13={sub_id_13}&date={date:U}&external_id={subid}&client_ip_address={ip}&client_user_agent={user_agent}&ct={city}&st={region}&country={country_name}&name={sub_id_14}&phone={sub_id_15}&revenue={conversion_revenue}`

      **Parameters Setup:**
      <table>
      <tr><td>	Name		      </td><td>	Parameter 					    </td><td>	Placeholder	                            </td></tr>
      <tr><td>	----		      </td><td>	---------					      </td><td>	-----------	                            </td></tr>
      <tr><td>	External ID   </td><td>	(none)						      </td><td>	(none)	                                </td></tr>
      <tr><td>	----		      </td><td>	---------					      </td><td>	-----------	                            </td></tr>
      <tr><td>	(none)        </td><td>	sub_id_6 	            </td><td>	(none)		                              </td></tr>
      <tr><td>	----		      </td><td>	---------					      </td><td>	-----------	                            </td></tr>
      <tr><td>	FBP           </td><td>	sub_id_8 (fbp)	    </td><td>	(none)		                              </td></tr>
      <tr><td>	Lead's Email  </td><td>	sub_id_9 (email)	  </td><td>	(none)		                              </td></tr>
      <tr><td>	FB Click ID   </td><td>	sub_id_10 (fbclid)	</td><td>	(none)		                              </td></tr>
      <tr><td>	Pixel ID      </td><td>	sub_id_11 (pixel)	  </td><td>	Your Pixel ID		                        </td></tr>
      <tr><td>	Access Token 	</td><td>	sub_id_12 (token)		</td><td>	Access Token for your Pixel		          </td></tr>
      <tr><td> Event URL      </td><td>	sub_id_13	(domain)	</td><td>	Link to your white page or {domain}		</td></tr>
      <tr><td> Lead's Name	  </td><td>	sub_id_14	(name)		</td><td>	(none)		                              </td></tr>
      <tr><td> Lead's Phone   </td><td>	sub_id_15	(phone)		</td><td>	(none)		                              </td></tr>
      </table>
     <hr>
    - **Binom:**
  
      Select `Facebook` as a template. Rename to `APIFB` and select `Send all` in `Advanced settings` > `S2S postback mode`.

      Link: `http://127.0.0.1/apifb/binom.php?sub_id_10={externalid}&sub_id_11={t7}&sub_id_12={t8}&sub_id_13={domain}&external_id={clickid}&client_ip_address={ip}&client_user_agent={user_agent}&ct={city}&st={region}&country={country_code}&name={t9}&phone={t10}&revenue={payout}`

      **Parameters Setup:**
      <table>
      <tr><td>	Description	</td><td>	Parameter 	</td><td>	Placeholder	                  </td><td>	Name		       </td></tr>
      <tr><td>	----		    </td><td>	---------		</td><td>	-----------	                  </td><td>	------		     </td></tr>
      <tr><td>	External ID </td><td>	fbclid		</td><td>	(none)	                      </td><td>				         </td></tr>
      <tr><td>	----		    </td><td>	---------		</td><td>	-----------	                  </td><td>	------		     </td></tr>
      <tr><td>	Token 7  	  </td><td>	pixel	    </td><td>	Your Pixel ID		              </td><td>	Pixel ID       </td></tr>
      <tr><td>	Token 8 	  </td><td>	token		  </td><td>	Access Token for your Pixel		</td><td>	Access Token 	 </td></tr>
      <tr><td>   Token 9 	  </td><td>	name			</td><td>		(none)	                        </td><td> Lead's Name    </td></tr>
      <tr><td> 	Token 10	  </td><td>	phone			</td><td>		(none)	                         </td><td> Lead's Phone	 </td></tr>
      </table>
      <hr>
    - **Voluum:**
  
      Select `Facebook` as a template. Rename to `APIFB` and enable `Traffic source postback URL per event type` under `Passing conversion info to traffic source` menu.

      Link for `Lead`/`reg` events: `http://IP_WHERE_APIFB_IS_INSTALLED/apifb/lead.php?sub_id_10={externalid}&sub_id_11={var9}&sub_id_12={var10}&sub_id_13={trackingdomain}&external_id={click.id}&client_ip_address={ip}&client_user_agent={useragent}&ct={city}&st={region}&country={country}`

      Link for `Sale`/`dep` events: `http://IP_WHERE_APIFB_IS_INSTALLED/apifb/sale.php?sub_id_10={externalid}&sub_id_11={var9}&sub_id_12={var10}&sub_id_13={trackingdomain}&external_id={click.id}&client_ip_address={ip}&client_user_agent={useragent}&ct={city}&st={region}&country={country}&revenue={payout}`

      _Per latest customers' compains, it is recommended to put Pixel ID and Access Token **DIRECTLY** into the link._

      **Parameters Setup:**
      <table>
      <tr><td>	Name	        </td><td>	TS Parameter  </td><td>	TS Token	                    </td><td>	VLM token		  </td></tr>
      <tr><td>	----		      </td><td>	---------	    </td><td>	-----------	                  </td><td>	------		    </td></tr>
      <tr><td>	External ID 1 </td><td>	fbclid	    </td><td>	(none)	                      </td><td>	{externalid}</td></tr>
      <tr><td>	----		      </td><td>	---------     </td><td>	-----------	                  </td><td>	------		    </td></tr>
      <tr><td>	Pixel ID  	  </td><td>	pixel	      </td><td>	Your Pixel ID		              </td><td>	{var9}      </td></tr>
      <tr><td>	Access Token	</td><td>	token		    </td><td>	Access Token for your Pixel		</td><td>	{var10} 	  </td></tr>
      </table>
      <hr>
5. The installation is complete. You may test it now.

# Enable User Data collecting (Only for Keitaro locally hosted offers)

Put this code inside the API file for your aff. network:

```php
$kt = "XXXXX"; // Your Postback Token (Maintenance > Postback URL)
$tmp = [
    'subid'     => $_POST['subid'],
    'sub_id_8'  => $_POST['fbp'],
    'sub_id_14' => $_POST['name'],
    'sub_id_15' => $_POST['phone'],
    'status'    => 'lead',
];
file_get_contents("http://127.0.0.1/" . $kt . "/postback?" . http_build_query($tmp));
```

Make sure to check that the parameters names are correct and correspond to the landing ones. Afterwards, add the code right before the redirect to the `Thank you` page.