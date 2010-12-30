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
							
							<h2>2010 Anzang Finalist</h2>
							
							<p class="anzang-blurb">ANZANG (Australia, New Zealand, Antarctic and the New Guinea region) nature photography competition is widely regarded as the premier wildlife photography competition for Australia and its surrounds. Each year since 2003, over a thousand images are submitted by professional and amateur photographers are submitted to the South Australian Museum to be judged. Roughly 100 of the best images are published in the corresponding book and toured in art galleries and museums. </p>

							
							<span id="publications-feature"></span>
							
						</div><!--/#second-level-feature-->
						
						<div id="second-level-primary-content">
							
							<ul id="publications-list">
								<li>
									<h3 class="ui-sub-heading">Finalist - Animal Behaviour</h3>
									<p>Snake eating frog. Animal Behaviour. Rough-scaled Snake (Tropidechis carinatus), Red-eyed Treefrog (Litoria chloris) Mt Glorious, QLD</p>
									<p>
									On a rainy summer's evening a rock-lined cascade echoes with the mass chorus of Red-eyed Treefrogs (Litoria chloris) competing to mate. But potential mates are not the only animal active in the rainforest tonight. The highly venomous Rough-scaled Snake (Tropidechis carinatus) is on the prowl, and again the frog is competing - this time for its life.
									</p>
									
									<img src="{$workspace}/images/publications-snake1.jpg" alt="Snake eating frog" />
									
								</li>
								
								<li>
									<h3 class="ui-sub-heading">Finalist - Threatened species</h3>
									<p>Frog. Threatened species category. Listed as Vulnerable in QLD. Cascade tree frog Litoria pearsoniana. Mt Glorious, QLD</p>
									<p>
									The aptly named Cascade Treefrog (Litoria pearsoniana) calls from streamside rocks and vegetation. During summer rains the stream swells and the babbling creek flows onto the rocks at the base of the cascade, spraying water droplets. Like many frog species, its populations are in decline, possibly due to disease stemming from Chytrid fungus.
									</p>
									
									<img src="{$workspace}/images/publications-frog1.jpg" alt="Cascade tree frog" />
									
								</li>
								
								<li>
									<h3 class="ui-sub-heading">Finalist - Animal portrait</h3>
									<p>Tree snake. Animal portrait. Brown Tree Snake (Boiga irregularis) Springbrook,QLD </p>
									<p>
									Reptiles are ectothermic – they require an external heat source to raise their body temperature above the ambient air temperature. Nocturnal snakes are frequently encountered on road surfaces where, sadly, they are often hit by passing cars. A Brown Tree Snake (Boiga irregularis) is ushered from the road but pauses briefly to be photographed.									
									</p>
									
									<img src="{$workspace}/images/publications-snake2.jpg" alt="Brown Tree Snake" />
									
								</li>
							</ul>
							
							
							
							<span id="second-level-primary-content-shadow"></span>
						</div><!--/#second-level-primary-content-->
						
						
						
					</div><!--/#content-container-->
					
					
					
					

				</div>
				<!-- /#content -->
	
	
</xsl:template>
</xsl:stylesheet>