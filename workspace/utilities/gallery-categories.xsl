<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:template match="gallery-categories">
		<ul>
			<xsl:apply-templates select="entry" />
		</ul>
	</xsl:template>


	<xsl:template match="gallery-categories/entry">
		<li>
			<a href="{$root}/portfolio/{category-name/@handle}">
				<xsl:value-of select="category-name"/>	
			</a>
		</li>
	</xsl:template>

	<xsl:template match="gallery-categories/entry" mode="portfolio-navigation" >
		<li>
			
			<a class="ui-main-button" href="{$root}/portfolio-category/{category-name/@handle}">
				<xsl:if test="category-name/@handle = $category-alias" >
					<xsl:attribute name="class">
						<xsl:value-of select="'ui-main-button ui-main-button-active'" />
					</xsl:attribute>
					 
				</xsl:if>
			
				<span><xsl:value-of select="category-name"/></span>
			</a>
		</li>
	</xsl:template>


	<xsl:template match="gallery-categories/entry" mode="portfolio-category-navigation" >
		<li>
			
			<a href="{$root}/portfolio-category/{category-name/@handle}">
				<img src="{$workspace}{category-image/@path}/{category-image/filename}" alt=""/>
				<span><xsl:value-of select="category-name"/></span>
			</a>
		</li>

	</xsl:template>

</xsl:stylesheet>