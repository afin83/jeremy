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
						
						<div id="second-level-feature">
							
							<p>Jeremy Ringma, a wildlife ecologist and biomechanic, became interested in wildlife photography when he began his Bachelor of Science degree in 2007. Jeremy began taking photographs on university field excursions and developed a passion for capturing images of animals in their natural environment.</p>
							
							<span id="about-feature"></span>
							
						</div><!--/#second-level-feature-->
						
						<div id="second-level-primary-content">
							
							<p>Since completing his Honours project, Jeremy has been travelling around Australia and working as a tutor at the University of Queensland and as a research assistant at the University of the Sunshine Coast. Jeremy has found that field work offers unique photographic opportunities not often available to many other wildlife photographers.</p>
							
							<p>
							Jeremy uses a variety of equipment and photographic techniques to capture the diversity of Australian wildlife. Much of Australia's wildlife is nocturnal and Jeremy enjoys the challenge of finding these species to photograph. He has found that the use of off camera lighting in the field provides the best results for nocturnal wildlife.
							</p>
							
							<p>Based in Brisbane, Jeremy spends much of his time in South-East Queensland in habitats ranging from rainforests to mangroves and wallum.</p>
							
							<p>
							Jeremy has a Certificate II in Photography and has further developed his knowledge of photography beyond this qualification. Jeremy has recently had three images published in the 2010 ANZANG wildlife photography competition and the Stanton Library exhibition, "A Natural History of North Sydney".
							</p>
							
							<div id="equipment">
								
								<h3>Equipment</h3>
								
							</div><!--/#equipment-->
							
							<div id="about-view-work">
								
								<a href="/portfolio">	
								<h3 class="ui-sub-heading">View Work</h3>
								</a>
								
							</div><!--/#about-view-work-->
							
							<span id="second-level-primary-content-shadow"></span>
						</div><!--/#second-level-primary-content-->
						
						
						
					</div><!--/#content-container-->
					
					
					
					

				</div>
				<!-- /#content -->	
	
	
	
</xsl:template>
</xsl:stylesheet>

