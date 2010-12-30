<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:import href="../utilities/master.xsl"/>
<xsl:import href="../utilities/gallery-categories.xsl"/>
<xsl:import href="../utilities/gallery-images.xsl"/>

<xsl:output method="xml"
	doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN"
	doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"
	omit-xml-declaration="yes"
	encoding="UTF-8"
	indent="yes" />


<xsl:template match="/data">
	
	<div id="content-heading">
						
		<h1><xsl:value-of select="$page-title"/></h1>
		
		<ul id="porfolio-nav">
			<xsl:apply-templates select="gallery-categories/entry" mode="portfolio-navigation" />
		</ul>	
	
	</div><!--/#content-heading-->
	
	<div id="content-container">
						
						<div id="primary-content-portfolio-secondary">
							
							<h3 class="ui-sub-heading">
								<xsl:value-of select="$category-alias" />
							</h3>
							
							<p>These photographs are available as stock images or to purchase individually as prints. Jeremy is will also accept commissions for special projects if his images don't meet your requirements.</p>
							<p>
For prices or general enquiries, contact Jeremy via the details on the contact page.</p>
							
						</div><!--/#primary-content-portfolio-main-->
						
							<div id="secondary-content-portfolio-secondary">
								<xsl:apply-templates select="gallery-images" />
							</div><!--/#secondary-content-portfolio-main-->
					
						<div class="clear"></div><!--/.clear-->
	
</div><!--/#content-container-->

	
</xsl:template>



</xsl:stylesheet>
