<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:template match="gallery-images">
		<ul>
			<xsl:apply-templates select="entry" />
		</ul>
	</xsl:template>
	
	<xsl:template match="gallery-images/entry">
		<li>
			
			<a rel="gallery" href="{$workspace}/image/?filter=gallery-category-big&amp;file={image/@path}/{image/filename}" ><img src="{$workspace}/image/?filter=gallery-category-small&amp;file={image/@path}/{image/filename}" alt="" /></a>
															
			<h4><xsl:value-of select="image-title"/></h4>
			<p>Photo id: <xsl:value-of select="image-code"/></p>
				
		</li>
	</xsl:template>

</xsl:stylesheet>