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
						
						<h1>404 Error: Page Not Found</h1>	
					
					</div><!--/#content-heading-->

					
					<div id="content-container">
						<p>Head back to <a href="{$root}/">home</a> or <a href="{$root}/contact/">contact</a> me.</p>
						
						
						
						
					</div><!--/#content-container-->
					
					
					
					

	</div>
	<!-- /#content -->	
	
	
</xsl:template>

</xsl:stylesheet>