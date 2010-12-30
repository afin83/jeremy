<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:import href="../utilities/master.xsl"/>

<xsl:output method="xml"
	doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN"
	doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"
	omit-xml-declaration="yes"
	encoding="UTF-8"
	indent="yes" />

<xsl:template match="/data">
	
					<div id="content">
					
					<div id="content-heading">
						
						<h1><xsl:value-of select="$page-title"/></h1>	
					
					</div><!--/#content-heading-->

					
					<div id="content-container">
						
						<div id="primary-content-portfolio-main">
							
							<p>For all enquiries please don't hesitate to contact Jeremy to see how he can help with your next project.</p>
							
							<p class="contact-details">Email: <a href="#">jeremy.ringma@uqconnect.edu.au</a></p>
							<p class="contact-details">Phone: 0410 603 345</p>
							
							<span id="contact-main-image"></span>
							
						</div><!--/#primary-content-portfolio-main-->
						
						<div id="secondary-content-portfolio-main" class="contact-form">
							
							<p>Alternatively if you would like to make an enquiry regarding any of the images in Jeremy’s portfolio, please send an enquiry.</p>
							
							<form id="contact" action="#" method="get" name="#">
								<fieldset>
									<legend class="accessibility" >Contact Jeremy Ringma</legend>

									<p>
										<label for="input1">First Name</label>
											<input id="input1" name="input" type="text" />
									</p>
									
									<p>
										<label for="input1">Last Name</label>
											<input id="input1" name="input" type="text" />
									</p>
									
									<p>
										<label for="input1">Email Address</label>
											<input id="input1" name="input" type="text" />
									</p>
									
									<p>
										<label for="input1">Phone Number</label>
											<input id="input1" name="input" type="text" />
									</p>
									
									<p>
										<label for="input1">Enquiery <span>(If you are enquiring about an impage, please 
include the images reference number)</span></label> 
											<textarea name="contact_enquiry" id="contact_enquiry" rows="5" title="Please enter your enquiry details"></textarea> 
									</p>
											
									<!--Button-->
									<p>
											<input id="input1" name="input" type="submit" value="Send"/>
									</p>
								
								</fieldset>
							</form>							
							
						</div><!--/#secondary-content-portfolio-main-->
						
						<div class="clear"></div><!--/.clear-->
						
					</div><!--/#content-container-->
					
					
					
					

				</div>
				<!-- /#content -->
	
</xsl:template>
</xsl:stylesheet>