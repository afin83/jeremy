<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:import href="../utilities/page-title.xsl"/>
<xsl:import href="../utilities/navigation.xsl"/>
<xsl:import href="../utilities/date-time.xsl"/>


<xsl:output method="xml"
	doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN"
	doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"
	omit-xml-declaration="yes"
	encoding="UTF-8"
	indent="yes" />

<xsl:variable name="is-logged-in" select="/data/events/login-info/@logged-in"/>

<xsl:template match="/">

<html>
	<head>
		<title>
			<xsl:value-of select="$page-title"/>
		</title>
		<link rel="alternate" type="application/rss+xml" href="{$root}/rss/" />
		
		<link rel="stylesheet" type="text/css" href="{$workspace}/css/reset.css" />
		<link rel="stylesheet" type="text/css" href="{$workspace}/css/nav.css" />
		<link rel="stylesheet" type="text/css" href="{$workspace}/css/base.css" />
		
		<link rel="icon" type="image/vnd.microsoft.icon" href="{$workspace}/images/favicon.ico" />
		<link rel="SHORTCUT ICON" href="{$workspace}/images/favicon.ico" />
		
		<script type="text/javascript" src="{$workspace}/js/jquery-1.4.4.min.js"></script>
		<script type="text/javascript" src="{$workspace}/js/jquery.easing-1.3.pack.js"></script>
		<script type="text/javascript" src="{$workspace}/js/jquery.mousewheel-3.0.4.pack.js"></script>
		<script type="text/javascript" src="{$workspace}/js/jquery.fancybox-1.3.4.pack.js"></script>
		
		<script type="text/javascript" src="{$workspace}/js/site.js"></script>
		
		<script type="text/javascript" src="{$workspace}/js/cufon-1.09i.js"></script>
		<script type="text/javascript" src="{$workspace}/js/futura_300-futura_500.font.js"></script>
		<script type="text/javascript">
			
			Cufon.replace( '#content h1, #feature, #contact input[type="submit"], #equipment h3, #second-level-feature h2');
			
			Cufon.replace( '.ui-sub-heading', {
				textShadow: '1px 1px 0px #b8cc4b'
			});
			
			Cufon.replace( '.ui-main-button', {
				textShadow: '1px 1px 0px #373737'
			});
			
			
			
			
		</script>		

	</head>

	<body class="{$root-page}" id="{$page-title}">
	
		<div id="wrapper" class="default">
			
				<div id="header">
				
					<div id="header-wrapper">
				
						<div id="brand">
							<h1><a href="/"><span class="accessibility">Jeremy Ringma Photography</span></a></h1>
						</div><!-- /#brand -->
					
						<ul id="navigation">
							<li id="navigation-item-1"><a href="/"><span class="accessibility">Home</span></a></li>
							<li id="navigation-item-2"><a href="/about"><span class="accessibility">About</span></a></li>
							<li id="navigation-item-3"><a href="/publications"><span class="accessibility">Publications</span></a></li>
							<li id="navigation-item-4"><a href="/services"><span class="accessibility">Services</span></a></li>
							<li id="navigation-item-5"><a href="/portfolio">
								
								<xsl:if test="$root-page = 'portfolio'" >
									<xsl:attribute name="class">
										<xsl:value-of select="'active'" />
									</xsl:attribute>
								</xsl:if>
								
								<span class="accessibility">Portfolio</span>
							
							</a></li>
							<li id="navigation-item-6"><a href="/contact"><span class="accessibility">Contact</span></a></li>
						</ul>
					
					</div><!--/#header-wrapper-->
                
                </div><!-- /#header -->
			
			<div id="container">
			
				<div id="content">
				
					<!-- content output -->
					<xsl:apply-templates match="/data"/>
					
				</div>
				
				<div id="footer">
				
					<div id="footer-brand">
						<h6><span class="accessibility">Jeremy Ringma Photography</span></h6>
					</div>
					
					<p id="footer-copyright">Jeremy Ringma Photography</p>
					
					<ul id="footer-nav">
						<li><a href="#">Home</a></li>
						<li><a href="#">About</a></li>
						<li><a href="#">Publications</a></li>
						<li><a href="#">Services</a></li>
						<li><a href="#">Portfolio</a></li>
						<li><a href="#">Contact</a></li>
					</ul>
				
				</div><!-- /#footer -->
			</div><!-- /#container -->
		</div><!--/#wrapper-->	
			
	</body>
</html>

</xsl:template>

</xsl:stylesheet>