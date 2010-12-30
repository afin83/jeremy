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

				<div id="feature"><a href="/publications">
					
					<h2>2010 ANZANG Finalist</h2>
					
					<ul>
						<li>Finalist - Animal Behavour</li>
						<li>Finalist - Threatened Species</li>
						<li>Finalist - Animal Portrait</li>
					</ul>
				
					<span id="feature-image"></span>
					</a>
				</div>
				<!-- /#feature -->
				
				<div id="content">
					
					<ul id="home-content">
						<li id="sub-content-1">
							
							<ul>
								<li><a href="/services">Wildlife photography</a></li>
								<li><a href="/services">Landscape photography</a></li>
								<li><a href="/services">Stock Images</a></li>
							</ul>
						
						</li>
						<li id="sub-content-2">
							<span class="accessibility">Bird Photography</span>
							
						</li>
						<li id="sub-content-3"><span class="accessibility">Landscape Photography</span></li>
					</ul>
					
					<span id="home-shadow"></span>
				</div>
				<!-- /#content -->	
	
	
	
</xsl:template>
</xsl:stylesheet>

